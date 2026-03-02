<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Inventory;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate inventory value (cost)
        $inventoryCost = 0;
        $inventoryValue = 0;
        $inventories = Inventory::with('product')->get();
        foreach ($inventories as $inv) {
            $cost = $inv->product?->cost_price ?? 0;
            $price = $inv->product?->price ?? 0;
            $inventoryCost += $cost * $inv->stock_quantity;
            $inventoryValue += $price * $inv->stock_quantity;
        }

        // Calculate revenue and profit from completed orders
        $revenue = Order::where('status', 'completed')->sum('total_amount');
        
        $profit = 0;
        $completedOrders = Order::where('status', 'completed')->with('items')->get();
        foreach ($completedOrders as $order) {
            foreach ($order->items as $item) {
                $cost = $item->product?->cost_price ?? 0;
                $profit += ($item->price - $cost) * $item->quantity;
            }
        }

        $stats = [
            'users' => User::count(),
            'customers' => Customer::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => $revenue,
            'profit' => $profit,
            'inventory_cost' => $inventoryCost,
            'inventory_value' => $inventoryValue,
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}
