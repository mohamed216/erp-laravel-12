@extends('layout.app')
@section('title', 'Create Product')
@section('content')
<form method="POST" action="/products">@csrf
<input name="name" class="form-control mb-2" placeholder="Name" required>
<input name="sku" class="form-control mb-2" placeholder="SKU" required>
<input name="price" type="number" class="form-control mb-2" placeholder="S_price" required>
<input name="stock" type="number" class="form-control mb-2" placeholder="Stock" value="0">
<button class="btn btn-primary">Create</button>
</form>
@endsection
