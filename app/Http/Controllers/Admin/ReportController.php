<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Expense;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $r)
    {
        $from = $r->from ?? date('Y-m-01');
        $to = $r->to ?? date('Y-m-d');
        
        $orders = Order::whereBetween('created_at', [$from, $to])
            ->where('status', 'completed')
            ->with('items')
            ->get();
        
        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();
        
        $profit = 0;
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $cost = $item->product?->cost_price ?? 0;
                $profit += ($item->price - $cost) * $item->quantity;
            }
        }
        
        return view('admin.reports.sales', compact('orders', 'totalSales', 'totalOrders', 'profit', 'from', 'to'));
    }
    
    public function inventory()
    {
        $products = Product::with('inventory')->get();
        $lowStock = $products->filter(fn($p) => ($p->inventory?->stock_quantity ?? 0) < 10);
        
        $totalValue = 0;
        $totalCost = 0;
        foreach ($products as $p) {
            $qty = $p->inventory?->stock_quantity ?? 0;
            $totalValue += $p->price * $qty;
            $totalCost += ($p->cost_price ?? 0) * $qty;
        }
        
        return view('admin.reports.inventory', compact('products', 'lowStock', 'totalValue', 'totalCost'));
    }
    
    public function expenses(Request $r)
    {
        $from = $r->from ?? date('Y-m-01');
        $to = $r->to ?? date('Y-m-d');
        
        $expenses = Expense::whereBetween('date', [$from, $to])->get();
        $total = $expenses->sum('amount');
        
        return view('admin.reports.expenses', compact('expenses', 'total', 'from', 'to'));
    }
    
    public function profit(Request $r)
    {
        $from = $r->from ?? date('Y-m-01');
        $to = $r->to ?? date('Y-m-d');
        
        $orders = Order::whereBetween('created_at', [$from, $to])
            ->where('status', 'completed')
            ->with('items')
            ->get();
        
        $revenue = $orders->sum('total_amount');
        
        $cost = 0;
        $profit = 0;
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $itemCost = ($item->product?->cost_price ?? 0) * $item->quantity;
                $cost += $itemCost;
                $profit += ($item->price * $item->quantity) - $itemCost;
            }
        }
        
        $expenses = Expense::whereBetween('date', [$from, $to])->sum('amount');
        $netProfit = $profit - $expenses;
        
        return view('admin.reports.profit', compact('revenue', 'cost', 'profit', 'expenses', 'netProfit', 'from', 'to'));
    }
}
