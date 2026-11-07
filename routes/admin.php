<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/users');
Route::resource('users', UserController::class)->except(['show']);
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/categories/success', [CategoryController::class, 'save'])->name('category.save');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products/save', [ProductController::class, 'save'])->name('product.save');