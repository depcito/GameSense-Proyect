<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * List the orders placed by the authenticated user.
     */
    public function index(): View
    {
        $viewData = [
            'title' => 'Pedidos',
            'orders' => Order::withCount('items')
                ->where('user_id', Auth::id())
                ->latest('date')
                ->latest('id')
                ->get(),
        ];

        return view('order.index', ['viewData' => $viewData]);
    }

    /**
     * Turn the cart into an order. Prices are taken from the products, never from the request.
     */
    public function save(Request $request): RedirectResponse
    {
        $cart = $request->session()->get(CartController::SESSION_KEY, []);

        if ($cart === []) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Tu carrito está vacío.']);
        }

        $order = DB::transaction(function () use ($cart) {
            $products = Product::whereIn('id', array_keys($cart))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $errors = [];

            foreach ($cart as $productId => $quantity) {
                $product = $products->get($productId);

                if ($product === null) {
                    $errors[] = 'Uno de los productos del carrito ya no está disponible.';
                } elseif ($quantity > $product->getStock()) {
                    $errors[] = 'Solo hay '.$product->getStock().' unidades disponibles de '.$product->getTitle().'.';
                }
            }

            if ($errors !== []) {
                return $errors;
            }

            $order = new Order;
            $order->setCode($this->generateCode());
            $order->setDate(now()->toDateString());
            $order->setStatus(Order::STATUS_PENDING);
            $order->setTotal(0);
            $order->user_id = Auth::id();
            $order->save();

            $total = 0;

            foreach ($cart as $productId => $quantity) {
                $product = $products->get($productId);
                $subtotal = $product->getPrice() * $quantity;

                $item = new Item;
                $item->setQuantity($quantity);
                $item->setUnitPrice($product->getPrice());
                $item->setSubtotal($subtotal);
                $item->order_id = $order->getId();
                $item->product_id = $product->getId();
                $item->save();

                $product->setStock($product->getStock() - $quantity);
                $product->save();

                $total += $subtotal;
            }

            $order->setTotal($total);
            $order->save();

            return $order;
        });

        if (is_array($order)) {
            return redirect()->route('cart.index')->withErrors($order);
        }

        $request->session()->forget(CartController::SESSION_KEY);

        return redirect()->route('order.show', ['id' => $order->getId()])
            ->with('success', 'Pedido creado correctamente. Ya puedes realizar el pago.');
    }

    public function show(int $id): View
    {
        $order = Order::with(['items.product', 'payments'])->findOrFail($id);

        $this->authorizeAccess($order);

        $viewData = [
            'title' => 'Detalle del pedido',
            'order' => $order,
            'canPay' => $order->canBeCancelled(),
        ];

        return view('order.show', ['viewData' => $viewData]);
    }

    public function cancel(int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        $this->authorizeAccess($order);

        if (! $order->cancel()) {
            return redirect()->route('order.show', ['id' => $id])
                ->with('error', 'Este pedido ya no se puede cancelar.');
        }

        return redirect()->route('order.show', ['id' => $id])
            ->with('success', 'Pedido cancelado correctamente.');
    }

    private function generateCode(): string
    {
        do {
            $code = 'ORD-'.now()->format('Ymd').'-'.Str::upper(Str::random(5));
        } while (Order::where('code', $code)->exists());

        return $code;
    }

    /**
     * Only the owner of the order can see it. Admins manage orders from the admin panel.
     */
    private function authorizeAccess(Order $order): void
    {
        abort_unless($order->user_id === Auth::id(), 403);
    }
}
