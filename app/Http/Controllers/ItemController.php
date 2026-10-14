<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * List the items of an order (?order_id=X).
     */
    public function index(Request $request): View
    {
        $order = $this->ownedOrder((int) $request->input('order_id'));

        $viewData = [
            'title' => 'Items del pedido',
            'order' => $order,
            'items' => Item::with('product')->where('order_id', $order->getId())->get(),
        ];

        return view('item.index', ['viewData' => $viewData]);
    }

    public function create(Request $request): View
    {
        $order = $this->ownedOrder((int) $request->input('order_id'));

        $viewData = [
            'title' => 'Agregar item',
            'order' => $order,
            'products' => Product::all(),
            'selectedProductId' => $request->input('product_id'),
        ];

        return view('item.create', ['viewData' => $viewData]);
    }

    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $order = $this->ownedOrder((int) $validated['order_id']);
        $product = Product::findOrFail($validated['product_id']);

        $item = new Item;

        $item->setQuantity($validated['quantity']);
        // The price is copied so later changes to the product do not alter past orders.
        $item->setUnitPrice($product->getPrice());
        $item->calculateSubtotal();

        $item->order_id = $order->getId();
        $item->product_id = $product->getId();

        $item->save();

        return redirect()->route('item.index', ['order_id' => $order->getId()]);
    }

    public function show(int $id): View
    {
        $item = Item::with(['order', 'product'])->findOrFail($id);
        $this->ownedOrder($item->order_id);

        $viewData = [
            'title' => 'Detalle del item',
            'item' => $item,
        ];

        return view('item.show', ['viewData' => $viewData]);
    }

    public function delete(int $id): RedirectResponse
    {
        $item = Item::findOrFail($id);
        $orderId = $this->ownedOrder($item->order_id)->getId();

        $item->delete();

        return redirect()->route('item.index', ['order_id' => $orderId]);
    }

    /**
     * Finds an order and makes sure it belongs to the logged user (or the user is admin).
     */
    private function ownedOrder(int $orderId): Order
    {
        $order = Order::findOrFail($orderId);
        $user = Auth::user();

        abort_unless(
            $order->user_id === $user->getId() || $user->getRole() === 'admin',
            403
        );

        return $order;
    }
}
