@extends('layout.app')
@section('title', 'Inventory Report')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card p-4 bg-primary text-white text-center">
            <h4>{{ $products->count() }}</h4>
            <p>Total Products</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 bg-info text-white text-center">
            <h4>{{ number_format($totalValue, 2) }}</h4>
            <p>Total Value</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 bg-danger text-white text-center">
            <h4>{{ $lowStock->count() }}</h4>
            <p>Low Stock Items</p>
        </div>
    </div>
</div>

@if($lowStock->count() > 0)
<div class="card mt-4 border-danger">
    <div class="card-header bg-danger text-white">
        <h5>Low Stock Alerts</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <tr><th>Product</th><th>Stock</th></tr>
            @foreach($lowStock as $p)
            <tr>
                <td>{{ $p->name }}</td>
                <td class="text-danger">{{ $p->inventory?->stock_quantity ?? 0 }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endif
@endsection
