@extends('layout.app')
@section('title', 'Edit Product')
@section('content')
<form method="POST" action="/products/{{ product->id }}">@csrf @method('PUT')
<input name="name" value="{{ product->name }}" class="form-control mb-2" placeholder="Name">
<input name="sku" value="{{ product->sku }}" class="form-control mb-2" placeholder="SKU">
<input name="price" value="{{ product->price }}" type="number" class="form-control mb-2" placeholder="S_price">
<button class="btn btn-primary">Update</button>
</form>
@endsection
