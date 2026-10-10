<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
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

    public function create(): View
    {
        $viewData = [];

        return view('category.create', ['viewData' => $viewData]);
    }

    public function save(Request $request)
    {
        $category = new Category();
        $category->setName($request->input('name'));
        $category->setDescription($request->input('description'));
        $category->save();

        return redirect()->route('category.index');
    }

    public function show(int $id): View
    {
        $viewData = [
            'category' => Category::findOrFail($id),
        ];

        return view('category.show', ['viewData' => $viewData]);
    }
}
