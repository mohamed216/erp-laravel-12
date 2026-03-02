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
                <td>
                    <form method="POST" action="/orders/{{ $o->id }}" class="d-inline">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()" style="width:120px" class="form-control form-control-sm">
                            <option value="pending" {{ $o->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="processing" {{ $o->status == 'processing' ? 'selected' : '' }}>🔄 Processing</option>
                            <option value="completed" {{ $o->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            <option value="cancelled" {{ $o->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="/orders/{{ $o->id }}" class="btn btn-sm btn-info">👁️ View</a>
                    @if($o->status != 'completed')
                    <form method="POST" action="/orders/{{ $o->id }}" class="d-inline">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">🗑️</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
