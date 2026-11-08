<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

// Payments (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/payments', 'App\Http\Controllers\PaymentController@index')->name('payment.index');
    Route::get('/payments/create', 'App\Http\Controllers\PaymentController@create')->name('payment.create');
    Route::post('/payments/save', 'App\Http\Controllers\PaymentController@save')->name('payment.save');
    Route::get('/payments/{id}', 'App\Http\Controllers\PaymentController@show')->name('payment.show');
});
