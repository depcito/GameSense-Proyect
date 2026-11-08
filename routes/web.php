<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('category.index');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('category.show');

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('product.index');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('product.show');

Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/reviews/{id}', 'App\Http\Controllers\ReviewController@show')->whereNumber('id')->name('review.show');

// Cart, checkout and orders (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
    Route::post('/cart/clear', 'App\Http\Controllers\CartController@clear')->name('cart.clear');
    Route::post('/cart/{id}/add', 'App\Http\Controllers\CartController@add')->name('cart.add');
    Route::post('/cart/{id}/remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');

    Route::get('/checkout', 'App\Http\Controllers\CheckoutController@index')->name('checkout.index');
    Route::post('/checkout/save', 'App\Http\Controllers\CheckoutController@save')->name('checkout.save');

    Route::get('/orders', 'App\Http\Controllers\OrderController@index')->name('order.index');
    Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show')->name('order.show');
    Route::post('/orders/{id}/cancel', 'App\Http\Controllers\OrderController@cancel')->name('order.cancel');

}); 

// Reviews (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/reviews/create', 'App\Http\Controllers\ReviewController@create')->name('review.create');
    Route::post('/reviews/save', 'App\Http\Controllers\ReviewController@save')->name('review.save');
    Route::delete('/reviews/{id}', 'App\Http\Controllers\ReviewController@delete')->whereNumber('id')->name('review.delete');
});
