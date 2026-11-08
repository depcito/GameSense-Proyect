<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => 'Products',
            'products' => Product::all(),
        ];

        return view('product.index', ['viewData' => $viewData]);
    }

    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        $viewData = [
            'title' => 'Product details',
            'product' => $product,
            'reviews' => $product->reviews()->with('user')->latest('date')->latest('id')->take(3)->get(),
            'reviewsCount' => $product->reviews()->count(),
            'averageRating' => $product->reviews()->avg('rating'),
        ];

        return view('product.show', ['viewData' => $viewData]);
    }
}
