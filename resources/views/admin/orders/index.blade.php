@extends('layout.app')
@section('title', 'Orders')
@section('content')
<div class="card">
    <div class="card-header"><a href="/orders/create" class="btn btn-primary btn-sm">+ New Order</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th></tr>
            @foreach($orders as $o)
            <tr><td>{{ $o->order_number }}</td><td>{{ $o->customer?->name }}</td><td>${{ $o->total_amount }}</td>
            <td><span class="badge bg-{{ $o->status=='completed'?'success':'warning' }}">{{ $o->status }}</span></td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
