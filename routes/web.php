
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');


Route::get('/categories', [CategoryController::class, 'index'])
    ->name('category.index');

Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->name('category.show');


Route::get('/products', [ProductController::class, 'index'])
    ->name('product.index');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('product.show');
