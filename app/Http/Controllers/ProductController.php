<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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

    public function create(): View
    {
        $viewData = [
            'title' => 'Create product',
        ];

        return view('product.create', ['viewData' => $viewData]);
    }

    public function save(Request $request): RedirectResponse
    {
        $product = new Product();

        $product->setTitle($request->input('title'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));
        $product->setStock($request->input('stock'));
        $product->setFormat($request->input('format'));
        $product->setType($request->input('type'));
        $product->setPlatform($request->input('platform'));

        $product->category_id = $request->input('category_id');

        $product->save();

        return redirect()->route('product.index');
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
