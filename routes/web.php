<?php

use Illuminate\Support\Facades\Route;
Auth::routes();
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');
Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('category.create');
Route::post('/categories/success', 'App\Http\Controllers\CategoryController@save')->name('category.success');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

