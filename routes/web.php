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
