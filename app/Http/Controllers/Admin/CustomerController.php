<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r)
    {
        $customers = Customer::when($r->search, fn($q, $s) => $q->where('name', 'like', "%$s%"))->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create() { return view('admin.customers.create'); }

    public function store(Request $r)
    {
        Customer::create($r->validate(['name' => 'required', 'email' => 'required|email']));
        return redirect()->route('customers.index')->with('success', 'Customer created');
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $r, Customer $customer)
    {
        $customer->update($r->all());
        return redirect()->route('customers.index')->with('success', 'Customer updated');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('success', 'Customer deleted');
    }
}
