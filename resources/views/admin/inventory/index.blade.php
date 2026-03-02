@extends('layout.app')
@section('title', 'Inventory')
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table">
            <tr><th>Product</th><th>Stock</th><th>Status</th></tr>
            @foreach($inventories as $i)
            <tr><td>{{ $i->product?->name }}</td><td>{{ $i->stock_quantity }}</td>
            <td><span class="badge bg-{{ $i->stock_quantity < 10 ? 'danger' : 'success' }}">{{ $i->stock_quantity < 10 ? 'Low' : 'OK' }}</span></td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
