<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

// Cart and orders (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
    Route::post('/cart/clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');
    Route::post('/cart/{id}/add', 'App\Http\Controllers\CartController@add')->name('cart.add');
    Route::post('/cart/{id}/remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');

    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');
    Route::post('/orders/save', 'App\Http\Controllers\OrderController@save')->name('order.save');
    Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');
    Route::post('/orders/{id}/cancel', 'App\Http\Controllers\OrderController@cancel')->name('order.cancel');
});

// Payments (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/payments', 'App\Http\Controllers\PaymentController@index')->name('payment.index');
    Route::get('/payments/create', 'App\Http\Controllers\PaymentController@create')->name('payment.create');
    Route::post('/payments/save', 'App\Http\Controllers\PaymentController@save')->name('payment.save');
    Route::get('/payments/{id}', 'App\Http\Controllers\PaymentController@show')->name('payment.show');
});
