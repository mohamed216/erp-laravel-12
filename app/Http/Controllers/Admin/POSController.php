<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Inventory;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::with('inventory')->get();
        $customers = Customer::all();
        return view('admin.pos.index', compact('products', 'customers'));
    }

    public function createOrder(Request $r)
    {
        $order = Order::create([
            'order_number' => 'POS-' . date('YmdHis'),
            'customer_id' => $r->customer_id,
            'user_id' => auth()->id(),
            'total_amount' => 0,
            'status' => 'completed'
        ]);

        $total = 0;
        foreach ($r->items as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $product->price
                ]);
                $total += $product->price * $item['qty'];
                
                // Decrease inventory
                $inventory = Inventory::where('product_id', $item['id'])->first();
                if ($inventory) {
                    $inventory->stock_quantity = max(0, $inventory->stock_quantity - $item['qty']);
                    $inventory->save();
                }
            }
        }

        $order->update(['total_amount' => $total]);
        return response()->json(['success' => true, 'order' => $order]);
    }
}
