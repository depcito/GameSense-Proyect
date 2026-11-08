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
        $viewData = [
            'title' => 'Product details',
            'product' => Product::findOrFail($id),
        ];

        return view('product.show', ['viewData' => $viewData]);
    }
}
