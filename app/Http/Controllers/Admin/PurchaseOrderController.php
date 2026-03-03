<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
class PurchaseOrderController extends Controller
{
    public function index() { $orders = PurchaseOrder::with('supplier')->orderBy('id', 'DESC')->paginate(10); return view('admin.purchase_orders.index', compact('orders')); }
    public function create() { $suppliers = Supplier::all(); return view('admin.purchase_orders.create', compact('suppliers')); }
    public function store(Request $r) { PurchaseOrder::create(['order_number' => 'PO-' . date('Ymd') . rand(1000,9999), 'supplier_id' => $r->supplier_id, 'total_amount' => $r->total_amount, 'order_date' => $r->order_date, 'status' => 'pending']); return redirect('/purchase-orders')->with('success', 'Purchase order created'); }
    public function update(Request $r, PurchaseOrder $order) { $order->update(['status' => $r->status]); return back()->with('success', 'Status updated'); }
}
