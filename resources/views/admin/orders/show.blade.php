@extends('layout.app')
@section('title', 'Order Details')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Order #{{ $order->order_number }}</h4>
        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">{{ $order->status }}</span>
    </div>
    <div class="card-body">
        <p><strong>Customer:</strong> {{ $order->customer?->name }}</p>
        <p><strong>Total:</strong> ${{ $order->total_amount }}</p>
        
        <h5>Items</h5>
        <table class="table">
            <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product?->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->price }}</td>
                <td>${{ $item->price * $item->quantity }}</td>
            </tr>
            @endforeach
        </table>
        
        <form method="POST" action="/orders/{{ $order->id }}">@csrf @method('PUT')
            <label>Status:</label>
            <select name="status" class="form-control" style="width:auto;display:inline">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
