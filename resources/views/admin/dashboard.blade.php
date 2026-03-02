@extends('layout.app')
@section('title', 'Dashboard')
@section('page_title', __('dashboard'))
@section('content')

{{-- Basic Stats --}}
<div class="row mt-4">
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['users'] }}</h3><p>@lang('users')</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['customers'] }}</h3><p>@lang('customers')</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['products'] }}</h3><p>@lang('products')</p></div></div>
    <div class="col-md-3"><div class="card p-4 text-center"><h3>{{ $stats['orders'] }}</h3><p>@lang('orders')</p></div></div>
</div>

{{-- Financial Stats --}}
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card p-4 text-center bg-success text-white">
            <h4>{{ number_format($stats['revenue'], 2) }}</h4>
            <p>الإيرادات</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center bg-info text-white">
            <h4>{{ number_format($stats['profit'], 2) }}</h4>
            <p>الربح</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center bg-warning">
            <h4>{{ number_format($stats['inventory_cost'], 2) }}</h4>
            <p>تكلفة المخزون</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center bg-primary text-white">
            <h4>{{ number_format($stats['inventory_value'], 2) }}</h4>
            <p>قيمة المخزون</p>
        </div>
    </div>
</div>
@endsection
