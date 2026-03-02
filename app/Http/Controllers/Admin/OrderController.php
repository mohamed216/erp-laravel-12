<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
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
        return view('admin.orders.create', compact('customers'));
    }

    public function store(Request $r)
    {
        Order::create([
            'order_number' => 'ORD-' . date('Ymd') . rand(1000, 9999),
            'customer_id' => $r->customer_id,
            'user_id' => auth()->id(),
            'total_amount' => 0,
            'status' => 'pending'
        ]);
        return redirect()->route('orders.index')->with('success', 'Order created');
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
