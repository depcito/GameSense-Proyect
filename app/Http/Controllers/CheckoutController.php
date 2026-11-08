<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Show the checkout: delivery data, payment method and the summary of the cart.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $summary = CartController::summary($request->session()->get(CartController::SESSION_KEY, []));

        if ($summary['lines'] === []) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Tu carrito está vacío.']);
        }

        $viewData = [
            'title' => 'Finalizar compra',
            'lines' => $summary['lines'],
            'total' => $summary['total'],
            'methods' => Payment::METHODS,
            'user' => Auth::user(),
        ];

        return view('checkout.index', ['viewData' => $viewData]);
    }

    /**
     * Place the order and pay it in a single step. Prices are taken from the products, never from the request.
     */
    public function save(Request $request): RedirectResponse
    {
        $cart = $request->session()->get(CartController::SESSION_KEY, []);

        if ($cart === []) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Tu carrito está vacío.']);
        }

        $validated = $request->validate([
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_phone' => ['required', 'string', 'regex:/^[0-9+\-\s()]{7,20}$/'],
            'shipping_address' => ['required', 'string', 'max:255'],
            'shipping_city' => ['required', 'string', 'max:100'],
            'method' => ['required', 'string', Rule::in(Payment::METHODS)],
        ]);

        $order = DB::transaction(function () use ($cart, $validated) {
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
            $order->setShippingName($validated['shipping_name']);
            $order->setShippingPhone($validated['shipping_phone']);
            $order->setShippingAddress($validated['shipping_address']);
            $order->setShippingCity($validated['shipping_city']);
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

            Payment::register($order, $validated['method']);

            return $order;
        });

        if (is_array($order)) {
            return redirect()->route('cart.index')->withErrors($order);
        }

        $request->session()->forget(CartController::SESSION_KEY);

        return redirect()->route('order.show', ['id' => $order->getId()])
            ->with('success', 'Compra realizada correctamente. Tu pedido fue pagado.');
    }

    private function generateCode(): string
    {
        do {
            $code = 'ORD-'.now()->format('Ymd').'-'.Str::upper(Str::random(5));
        } while (Order::where('code', $code)->exists());

        return $code;
    }
}
