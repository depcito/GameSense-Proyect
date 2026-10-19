<?php

use Illuminate\Support\Facades\Route;
Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');
Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');
Route::post('/categories/success', 'App\Http\Controllers\CategoryController@save')->name('category.save');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create');
Route::post('/products/save', 'App\Http\Controllers\ProductController@save')->name('product.save');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

// payment routes
Route::get('/payments', 'App\Http\Controllers\PaymentController@index')->middleware('auth')->name('payment.index');
Route::get('/payments/create', 'App\Http\Controllers\PaymentController@create')->middleware('auth')->name('payment.create');
Route::post('/payments/save', 'App\Http\Controllers\PaymentController@save')->middleware('auth')->name('payment.save');
Route::get('/payments/{id}', 'App\Http\Controllers\PaymentController@show')->middleware('auth')->name('payment.show');
Route::patch('/payments/{id}/status', 'App\Http\Controllers\PaymentController@updateStatus')->middleware(['auth', 'admin'])->name('payment.updateStatus');
