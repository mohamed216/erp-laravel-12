<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Inventory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $r)
    {
        $orders = Order::with('customer')->when($r->status, fn($q, $s) => $q->where('status', $s))->orderBy('id', 'DESC')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::with('inventory')->get();
        return view('admin.orders.create', compact('customers', 'products'));
    }

    public function store(Request $r)
    {
        $order = Order::create([
            'order_number' => 'ORD-' . date('Ymd') . rand(1000, 9999),
            'customer_id' => $r->customer_id,
            'user_id' => auth()->id(),
            'total_amount' => 0,
            'status' => 'pending'
        ]);

        $total = 0;
        if ($r->products) {
            foreach ($r->products as $productId) {
                $qty = $r->quantities[$productId] ?? 1;
                $product = Product::find($productId);
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $qty,
                        'price' => $product->price
                    ]);
                    $total += $product->price * $qty;
                    
                    // Decrease inventory
                    $inventory = Inventory::where('product_id', $productId)->first();
                    if ($inventory) {
                        $inventory->stock_quantity = max(0, $inventory->stock_quantity - $qty);
                        $inventory->save();
                    }
                }
            }
        }

        $order->update(['total_amount' => $total]);
        return redirect()->route('orders.index')->with('success', 'Order created - Stock updated');
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'customer');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $r, Order $order)
    {
        $oldStatus = $order->status;
        $newStatus = $r->status;
        
        // If cancelling order, restore stock
        if ($oldStatus != 'cancelled' && $newStatus == 'cancelled') {
            foreach ($order->items as $item) {
                $inventory = Inventory::where('product_id', $item->product_id)->first();
                if ($inventory) {
                    $inventory->stock_quantity += $item->quantity;
                    $inventory->save();
                }
            }
        }
        
        $order->update(['status' => $newStatus]);
        return back()->with('success', 'Order updated');
    }

    public function destroy(Order $order)
    {
        // Restore stock before delete
        foreach ($order->items as $item) {
            $inventory = Inventory::where('product_id', $item->product_id)->first();
            if ($inventory) {
                $inventory->stock_quantity += $item->quantity;
                $inventory->save();
            }
        }
        $order->delete();
        return back()->with('success', 'Order deleted - Stock restored');
    }
}
