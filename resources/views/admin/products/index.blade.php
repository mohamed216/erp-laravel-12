@extends('layout.app')
@section('title', 'المنتجات')
@section('content')
<div class="card">
    <div class="card-header"><a href="/products/create" class="btn btn-primary btn-sm">+ Add</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>الاسم</th><th>رمز</th><th>S_price</th><th>المخزون</th></tr>
            @foreach(products as p)
            <tr><td>{{ p->name }}</td><td>{{ p->sku }}</td><td>{{ p->price }}</td><td>{{ p->inventory?->stock_quantity ?? 0 }}</td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
