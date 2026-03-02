@extends('layout.app')
@section('title', 'Order Details')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Order #{{ $order->order_number }}</h4>
        @if($order->status == 'completed')
            <span class="badge bg-success">✅ Completed</span>
        @elseif($order->status == 'cancelled')
            <span class="badge bg-danger">❌ Cancelled</span>
        @elseif($order->status == 'processing')
            <span class="badge bg-info">🔄 Processing</span>
        @else
            <span class="badge bg-warning">⏳ Pending</span>
        @endif
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
        
        <h5 class="mt-4">تغيير الحالة:</h5>
        <form method="POST" action="/orders/{{ $order->id }}">
            @csrf @method('PUT')
            <div class="btn-group" role="group">
                <button type="submit" name="status" value="pending" class="btn btn-outline-warning {{ $order->status == 'pending' ? 'active' : '' }}">⏳ Pending</button>
                <button type="submit" name="status" value="processing" class="btn btn-outline-info {{ $order->status == 'processing' ? 'active' : '' }}">🔄 Processing</button>
                <button type="submit" name="status" value="completed" class="btn btn-outline-success {{ $order->status == 'completed' ? 'active' : '' }}">✅ Completed</button>
                <button type="submit" name="status" value="cancelled" class="btn btn-outline-danger {{ $order->status == 'cancelled' ? 'active' : '' }}">❌ Cancelled</button>
            </div>
        </form>
    </div>
</div>
@endsection
