<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $inventories = Inventory::with('product')->paginate(10);
        return view('admin.inventory.index', compact('inventories'));
    }

    public function update(Request $r, Inventory $inventory)
    {
        $inventory->update(['stock_quantity' => $r->stock_quantity]);
        return back()->with('success', 'Stock updated');
    }
}
