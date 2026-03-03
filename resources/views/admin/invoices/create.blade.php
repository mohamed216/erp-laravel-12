@extends('layout.app')
@section('title', 'Create Invoice')
@section('content')
<form method="POST" action="/invoices">@csrf
<div class="row">
    <div class="col-md-6">
        <label>Customer</label>
        <select name="customer_id" class="form-control" required>
            @foreach($customers as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Order (optional)</label>
        <select name="order_id" class="form-control">
            <option value="">Select Order</option>
            @foreach($orders as $o)
            <option value="{{ $o->id }}">{{ $o->order_number }} - {{ $o->total_amount }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <label>Total Amount</label>
        <input name="total_amount" type="number" step="0.01" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label>Paid Amount</label>
        <input name="paid_amount" type="number" step="0.01" class="form-control" value="0">
    </div>
</div>
<button class="btn btn-primary mt-3">Create</button>
</form>
@endsection
