@extends('layout.app')
@section('title', 'Create Order')
@section('content')
<form method="POST" action="/orders">@csrf
<div class="mb-3">
    <label>Customer</label>
    <select name="customer_id" class="form-control" required>
        <option value="">Select Customer</option>
        @foreach($customers as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>
<button class="btn btn-primary">Create Order</button>
</form>
@endsection
