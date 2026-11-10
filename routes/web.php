<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Home
Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

// Language
Route::post('/locale', [LocaleController::class, 'update'])
    ->name('locale.update');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('category.index');

Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->name('category.show');

// Products
Route::get('/products', [ProductController::class, 'index'])
    ->name('product.index');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('product.show');

// Reviews
Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')
    ->name('review.index');

Route::get('/reviews/{id}', 'App\Http\Controllers\ReviewController@show')
    ->whereNumber('id')
    ->name('review.show');

// Cart, checkout and orders (authenticated users)
Route::middleware('auth')->group(function () {

    // Cart
    Route::get('/cart', 'App\Http\Controllers\CartController@index')
        ->name('cart.index');

    Route::post('/cart/clear', 'App\Http\Controllers\CartController@clear')
        ->name('cart.clear');

    Route::post('/cart/{id}/add', 'App\Http\Controllers\CartController@add')
        ->name('cart.add');

    Route::post('/cart/{id}/remove', 'App\Http\Controllers\CartController@remove')
        ->name('cart.remove');

    // Checkout
    Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index')
        ->name('checkout.index');

    Route::post('/checkout/save', 'App\Http\Controllers\CheckoutController@save')
        ->name('checkout.save');

    // Orders
    Route::get('/orders', 'App\Http\Controllers\OrderController@index')
        ->name('order.index');

    Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')
        ->name('order.show');

    Route::post('/orders/{id}/cancel', 'App\Http\Controllers\OrderController@cancel')
        ->name('order.cancel');
});

// Reviews (authenticated users)
Route::middleware('auth')->group(function () {

    Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')
        ->name('review.create');

    Route::post('/reviews/save', 'App\Http\Controllers\ReviewController@save')
        ->name('review.save');

    Route::delete('/reviews/{id}', 'App\Http\Controllers\ReviewController@delete')
        ->whereNumber('id')
        ->name('review.delete');
});
// contact 
Route::view('/contact', 'home.contact')->name('contact');