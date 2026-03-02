<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/dashboard'));
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class);
Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('inventory', InventoryController::class)->except(['show', 'destroy', 'create', 'store']);
