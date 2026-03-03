@extends('layout.app')
@section('title', 'Create Purchase Order')
@section('content')
<form method="POST" action="/purchase-orders">@csrf
<div class="row">
    <div class="col-md-4"><label>Supplier</label><select name="supplier_id" class="form-control" required>@foreach($suppliers as $s)<option value="{{ $s->id }}">{{ $s->name }}</option>@endforeach</select></div>
    <div class="col-md-4"><label>Total Amount</label><input name="total_amount" type="number" step="0.01" class="form-control" required></div>
    <div class="col-md-4"><label>Date</label><input name="order_date" type="date" class="form-control" value="{{ date('Y-m-d') }}"></div>
</div>
<button class="btn btn-primary mt-3">Create</button>
</form>
@endsection
