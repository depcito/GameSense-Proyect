<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => __('controllers/ProductController.title.index'),
            'products' => Product::all(),
        ];

        return view('product.index', ['viewData' => $viewData]);
    }

    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        $viewData = [
            'title' => __('controllers/ProductController.title.show'),
            'product' => $product,
            'reviews' => $product->reviews()->with('user')->latest('date')->latest('id')->take(3)->get(),
            'reviewsCount' => $product->reviews()->count(),
            'averageRating' => $product->reviews()->avg('rating'),
        ];

        return view('product.show', ['viewData' => $viewData]);
    }
}
