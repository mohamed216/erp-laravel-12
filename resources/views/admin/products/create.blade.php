@extends('layout.app')
@section('title', 'Create Product')
@section('content')
<form method="POST" action="/products">@csrf
<div class="row">
    <div class="col-md-6">
        <input name="name" class="form-control mb-2" placeholder="اسم المنتج" required>
    </div>
    <div class="col-md-6">
        <input name="sku" class="form-control mb-2" placeholder="رمز المنتج" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <input name="price" type="number" step="0.01" class="form-control mb-2" placeholder="سعر البيع" required>
    </div>
    <div class="col-md-6">
        <input name="cost_price" type="number" step="0.01" class="form-control mb-2" placeholder="سعر التكلفة">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <input name="stock" type="number" class="form-control mb-2" placeholder="الكمية" value="0">
    </div>
</div>
<button class="btn btn-primary">إنشاء</button>
</form>
@endsection
