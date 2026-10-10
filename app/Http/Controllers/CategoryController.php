<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $viewData = ['categories' => Category::all(),];

        return view('categories.index', ['viewData' => $viewData]);
    }

    public function create(): View
    {
        $viewData = [];

        return view('categories.create', ['viewData' => $viewData]);
    }

    public function save(Request $request)
    {
        $category = new Category();
        $category->setName($request->input('name'));
        $category->setDescription($request->input('description'));
        $category->save();

        return redirect()->route('categories.index');
    }

    public function show(int $id): View
    {
        $viewData = [
            'category' => Category::findOrFail($id),
        ];

        return view('categories.show', ['viewData' => $viewData]);
    }
}
