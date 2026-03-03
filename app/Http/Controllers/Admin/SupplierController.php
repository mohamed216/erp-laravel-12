<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function store(Request $r)
    {
        Supplier::create($r->validate(['name' => 'required', 'email' => 'email']));
        return back()->with('success', 'Supplier added');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('success', 'Supplier deleted');
    }
}
