<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'title' => 'Inicio',
            'featuredProducts' => Product::with('category')
                ->take(4)
                ->get(),
            'categories' => Category::all(),
        ];

        return view('home.index', ['viewData' => $viewData]);
    }
}
