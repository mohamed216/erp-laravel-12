<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats
        $inventoryCost = 0;
        $inventoryValue = 0;
        foreach (\App\Models\Inventory::with('product')->get() as $inv) {
            $inventoryCost += ($inv->product?->cost_price ?? 0) * $inv->stock_quantity;
            $inventoryValue += ($inv->product?->price ?? 0) * $inv->stock_quantity;
        }

        $revenue = Order::where('status', 'completed')->sum('total_amount');
        $profit = 0;
        foreach (Order::where('status', 'completed')->with('items')->get() as $order) {
            foreach ($order->items as $item) {
                $cost = $item->product?->cost_price ?? 0;
                $profit += ($item->price - $cost) * $item->quantity;
            }
        }

        $expenses = Expense::sum('amount');
        $netProfit = $profit - $expenses;

        $stats = [
            'users' => User::count(),
            'customers' => Customer::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => $revenue,
            'profit' => $profit,
            'expenses' => $expenses,
            'net_profit' => $netProfit,
            'inventory_cost' => $inventoryCost,
            'inventory_value' => $inventoryValue,
        ];

        // Chart data
        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month');

        return view('admin.dashboard', compact('stats', 'monthlyOrders'));
    }
}
