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
     * Build the lines and the total of a cart ([product id => quantity]) using the current product prices.
     */
    public static function summary(array $cart): array
    {
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

        return ['lines' => $lines, 'total' => $total];
    }

    /**
     * Show the products the user has added to the cart.
     */
    public function index(Request $request): View
    {
        $summary = self::summary($request->session()->get(self::SESSION_KEY, []));

        $viewData = [
            'title' => __('controllers/CartController.title.index'),
            'lines' => $summary['lines'],
            'total' => $summary['total'],
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
                'quantity' => __('controllers/CartController.insufficient_stock', ['stock' => $product->getStock(), 'product' => $product->getTitle()]),
            ]);
        }

        $cart[$id] = $quantity;
        $request->session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')
            ->with('success', __('controllers/CartController.added'));
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $cart = $request->session()->get(self::SESSION_KEY, []);
        unset($cart[$id]);
        $request->session()->put(self::SESSION_KEY, $cart);

        return redirect()->route('cart.index')
            ->with('success', __('controllers/CartController.removed'));
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget(self::SESSION_KEY);

        return redirect()->route('cart.index')
            ->with('success', __('controllers/CartController.cleared'));
    }
}
