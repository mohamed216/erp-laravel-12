<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'customers' => Customer::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}
