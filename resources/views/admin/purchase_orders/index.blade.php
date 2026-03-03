@extends('layout.app')
@section('title', 'Purchase Orders')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between"><h4>Purchase Orders</h4><a href="/purchase-orders/create" class="btn btn-primary">+ New PO</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>PO #</th><th>Supplier</th><th>Date</th><th>Total</th><th>Status</th></tr>
            @foreach($orders as $o)
            <tr><td>{{ $o->order_number }}</td><td>{{ $o->supplier?->name }}</td><td>{{ $o->order_date }}</td><td>{{ $o->total_amount }}</td>
            <td><span class="badge bg-{{ $o->status == 'received' ? 'success' : 'warning' }}">{{ $o->status }}</span></td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
