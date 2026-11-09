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
            'title' => __('controllers/CategoryController.title.index'),
            'categories' => Category::all(),
        ];

        return view('category.index', ['viewData' => $viewData]);
    }

    public function create(): View
    {
        $viewData = ['title' => __('controllers/CategoryController.title.index')];

        return view('category.create', ['viewData' => $viewData]);
    }

    public function save(Request $request)
    {
        $category = new Category;
        $category->setName($request->input('name'));
        $category->setDescription($request->input('description'));
        $category->save();

        return redirect()->route('category.index');
    }

    public function show(int $id): View
    {
        $viewData = [
            'title' => __('controllers/CategoryController.title.show'),
            'category' => Category::with('products')->findOrFail($id),
        ];

        return view('category.show', ['viewData' => $viewData]);
    }
}
