@extends('layout.app')
@section('title', 'Orders')
@section('content')
<div class="card">
    <div class="card-header"><a href="/orders/create" class="btn btn-primary btn-sm">+ New Order</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>Order #</th><th>Customer</th><th>Total</th><th>Status</th><th>Actions</th></tr>
            @foreach($orders as $o)
            <tr>
                <td><a href="/orders/{{ $o->id }}">{{ $o->order_number }}</a></td>
                <td>{{ $o->customer?->name }}</td>
                <td>${{ $o->total_amount }}</td>
                <td><span class="badge bg-{{ $o->status=='completed'?'success':'warning' }}">{{ $o->status }}</span></td>
                <td>
                    <form method="POST" action="/orders/{{ $o->id }}" class="d-inline">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
