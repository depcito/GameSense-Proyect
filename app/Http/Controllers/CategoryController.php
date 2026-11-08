<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => 'Categories',
            'categories' => Category::all(),
        ];

        return view('category.index', ['viewData' => $viewData]);
    }

    public function show(int $id): View
    {
        $viewData = [
            'title' => 'Detalles de la categoría',
            'category' => Category::with('products')->findOrFail($id),
        ];

        return view('category.show', ['viewData' => $viewData]);
    }
}
