@extends('layout.app')
@section('title', 'Edit Order')
@section('content')
<form method="POST" action="/orders/{{ order->id }}">@csrf @method('PUT')
<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="pending" {{ order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ order->status == 'processing' ? 'selected' : '' }}>Processing</option>
        <option value="completed" {{ order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
</div>
<button class="btn btn-primary">Update</button>
</form>
@endsection
