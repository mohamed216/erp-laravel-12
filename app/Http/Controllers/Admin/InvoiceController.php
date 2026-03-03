<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $orders = Order::where('status', 'completed')->get();
        $customers = Customer::all();
        return view('admin.invoices.create', compact('orders', 'customers'));
    }

    public function store(Request $r)
    {
        Invoice::create([
            'invoice_number' => 'INV-' . date('Ymd') . rand(1000, 9999),
            'order_id' => $r->order_id,
            'customer_id' => $r->customer_id,
            'total_amount' => $r->total_amount,
            'paid_amount' => $r->paid_amount ?? 0,
            'status' => 'pending'
        ]);
        return redirect()->route('invoices.index')->with('success', 'Invoice created');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('customer', 'order');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function update(Request $r, Invoice $invoice)
    {
        $invoice->update([
            'paid_amount' => $r->paid_amount,
            'status' => $r->paid_amount >= $invoice->total_amount ? 'paid' : 'partial'
        ]);
        return back()->with('success', 'Invoice updated');
    }
}
