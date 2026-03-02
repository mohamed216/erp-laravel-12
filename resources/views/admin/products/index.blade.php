@extends('layout.app')
@section('title', 'Products')
@section('content')
<div class="card">
    <div class="card-header"><a href="/products/create" class="btn btn-primary btn-sm">+ Add</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>Name</th><th>SKU</th><th>Cost</th><th>Price</th><th>Profit</th><th>Stock</th></tr>
            @foreach($products as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td>{{ $p->sku }}</td>
                <td>{{ $p->cost_price ?? 0 }}</td>
                <td>{{ $p->price }}</td>
                <td><span class="badge bg-success">{{ $p->price - ($p->cost_price ?? 0) }}</span></td>
                <td>{{ $p->inventory?->stock_quantity ?? 0 }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
