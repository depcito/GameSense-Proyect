<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/users');

// Users
Route::resource('users', UserController::class)->except(['show']);

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categories/success', [CategoryController::class, 'save'])->name('category.save');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/save', [ProductController::class, 'save'])->name('product.save');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

// Orders
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.show');
Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

// Payments
Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payment.show');

// Reviews
Route::get('/reviews', [ReviewController::class, 'index'])->name('review.index');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
