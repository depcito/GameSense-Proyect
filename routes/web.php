<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'App\Http\Controllers\CategoryController@create')->name('categories.create');
Route::post('/categories/save', 'App\Http\Controllers\CategoryController@save')->name('categories.save');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('categories.show');
Auth::routes();
