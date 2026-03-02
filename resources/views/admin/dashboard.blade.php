@extends('layout.app')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('content')
<div class="row mt-4">
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['users'] }}</h3><p>Users</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['customers'] }}</h3><p>Customers</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['products'] }}</h3><p>Products</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['orders'] }}</h3><p>Orders</p></div></div>
</div>
<div class="row mt-4">
    <div class="col-md-12"><div class="card p-4"><h4>Revenue: ${{ number_format($stats['revenue'], 2) }}</h4></div></div>
</div>
@endsection
