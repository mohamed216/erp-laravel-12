<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;

// Products API
Route::get('/products', function () {
    return Product::with('inventory')->get();
});

Route::get('/products/{id}', function ($id) {
    return Product::with('inventory')->findOrFail($id);
});

// Customers API
Route::get('/customers', function () {
    return Customer::all();
});

Route::post('/orders', function (Request $request) {
    $order = \App\Models\Order::create([
        'order_number' => 'ORD-' . date('Ymd') . rand(1000, 9999),
        'customer_id' => $request->customer_id,
        'user_id' => 1,
        'total_amount' => $request->total_amount,
        'status' => 'pending'
    ]);
    return $order;
});

Route::get('/health', fn() => ['status' => 'OK', 'time' => now()]);
