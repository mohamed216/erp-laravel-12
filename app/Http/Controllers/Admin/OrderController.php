<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
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
                }
            }
        }

        $order->update(['total_amount' => $total]);
        return redirect()->route('orders.index')->with('success', 'Order created');
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'customer');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $r, Order $order)
    {
        $order->update(['status' => $r->status]);
        return back()->with('success', 'Order updated');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted');
    }
}
