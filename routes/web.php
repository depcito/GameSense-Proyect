<?php

use Illuminate\Support\Facades\Route;

Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')->middleware('auth')->name('review.create');
Route::post('/reviews/save', 'App\Http\Controllers\ReviewController@save')->middleware('auth')->name('review.save');
Route::get('/reviews/{id}', 'App\Http\Controllers\ReviewController@show')->name('review.show');
Route::delete('/reviews/{id}', 'App\Http\Controllers\ReviewController@delete')->middleware('auth')->name('review.delete');
