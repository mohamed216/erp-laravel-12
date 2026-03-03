<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ChartsController extends Controller
{
    public function index()
    {
        // Monthly revenue
        $revenueData = [];
        for ($m = 1; $m <= 12; $m++) {
            $revenueData[] = Order::whereMonth('created_at', $m)->where('status', 'completed')->sum('total_amount');
        }
        
        // Top products
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->selectRaw('products.name, SUM(order_items.quantity) as total_qty')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();
            
        // Orders by status
        $orderStatus = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
        
        return view('admin.charts.index', compact('revenueData', 'topProducts', 'orderStatus'));
    }
}
