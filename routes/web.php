<?php

use Illuminate\Support\Facades\Route;

// review routes
Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')->middleware('auth')->name('review.create');
Route::post('/reviews/save', 'App\Http\Controllers\ReviewController@save')->middleware('auth')->name('review.save');
Route::get('/reviews/{id}', 'App\Http\Controllers\ReviewController@show')->name('review.show');
Route::delete('/reviews/{id}', 'App\Http\Controllers\ReviewController@delete')->middleware('auth')->name('review.delete');
// item routes
Route::get('/items', 'App\Http\Controllers\ItemController@index')->name('item.index');
Route::get('/items/create', 'App\Http\Controllers\ItemController@create')->name('item.create');
Route::post('/items/save', 'App\Http\Controllers\ItemController@save')->name('item.save');
Route::get('/items/{id}', 'App\Http\Controllers\ItemController@show')->name('item.show');
Route::delete('/items/{id}', 'App\Http\Controllers\ItemController@delete')->name('item.delete');
