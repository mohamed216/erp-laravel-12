<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r)
    {
        $products = Product::with('inventory')->when($r->search, fn($q, $s) => $q->where('name', 'like', "%$s%"))->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create() { return view('admin.products.create'); }

    public function store(Request $r)
    {
        $p = Product::create($r->validate(['name' => 'required', 'sku' => 'required|unique:products', 'price' => 'required|numeric']));
        Inventory::create(['product_id' => $p->id, 'stock_quantity' => $r->stock ?? 0]);
        return redirect()->route('products.index')->with('success', 'Product created');
    }

    public function edit(Product $product) { return view('admin.products.edit', compact('product')); }

    public function update(Request $r, Product $product)
    {
        $product->update($r->all());
        return redirect()->route('products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted');
    }
}
