<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public const SESSION_KEY = 'cart';

    /**
     * Show the products the user has added to the cart.
     */
    public function index(Request $request): View
    {
        $cart = $request->session()->get(self::SESSION_KEY, []);
        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $lines = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = $products->get($productId);

            if ($product === null) {
                continue;
            }

            $subtotal = $product->getPrice() * $quantity;
            $total += $subtotal;

            $lines[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        $viewData = [
            'title' => 'Carrito',
            'lines' => $lines,
            'total' => $total,
        ];

        return view('cart.index', ['viewData' => $viewData]);
    }

    public function add(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($id);

        $cart = $request->session()->get(self::SESSION_KEY, []);
        $quantity = ($cart[$id] ?? 0) + (int) $request->input('quantity');

        if ($quantity > $product->getStock()) {
            return back()->withErrors([
                'quantity' => 'Solo hay '.$product->getStock().' unidades disponibles de '.$product->getTitle().'.',
            ]);
        }

        $cart[$id] = $quantity;
        $request->session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Producto agregado al carrito.');
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $cart = $request->session()->get(self::SESSION_KEY, []);
        unset($cart[$id]);
        $request->session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Producto eliminado del carrito.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget(self::SESSION_KEY);

        return redirect()->route('cart.index')
            ->with('success', 'Carrito vaciado.');
    }
}
