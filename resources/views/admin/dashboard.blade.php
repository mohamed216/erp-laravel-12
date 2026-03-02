@extends('layout.app')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('content')
<div class="row mt-4">
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ stats['users'] }}</h3><p>المستخدمين</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ stats['customers'] }}</h3><p>العملاء</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ stats['products'] }}</h3><p>المنتجات</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ stats['orders'] }}</h3><p>الطلبات</p></div></div>
</div>
<div class="row mt-4">
    <div class="col-md-12"><div class="card p-4"><h4>الإيرادات: {{ number_format(stats['S_revenue'], 2) }}</h4></div></div>
</div>
@endsection
