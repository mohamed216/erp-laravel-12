<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Setting;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $lowStock = Product::with('inventory')
            ->get()
            ->filter(fn($p) => ($p->inventory?->stock_quantity ?? 0) < (Setting::get('low_stock_alert', 10)));
        
        return view('admin.notifications.index', compact('lowStock'));
    }
}
