@extends('layout.app')
@section('title', 'Dashboard')
@section('page_title', __('dashboard'))
@section('content')

{{-- Basic Stats --}}
<div class="row mt-4">
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['users'] }}</h5><small>@lang('users')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['customers'] }}</h5><small>@lang('customers')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['products'] }}</h5><small>@lang('products')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['orders'] }}</h5><small>@lang('orders')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ number_format($stats['revenue'], 0) }}</h5><small>Revenue</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ number_format($stats['net_profit'], 0) }}</h5><small>Net Profit</small></div></div>
</div>

{{-- Financial --}}
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card p-4 bg-success text-white text-center">
            <h4>{{ number_format($stats['revenue'], 2) }}</h4>
            <p>Revenue</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 bg-info text-white text-center">
            <h4>{{ number_format($stats['profit'], 2) }}</h4>
            <p>Gross Profit</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 bg-warning text-center">
            <h4>{{ number_format($stats['expenses'], 2) }}</h4>
            <p>Expenses</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 bg-primary text-white text-center">
            <h4>{{ number_format($stats['inventory_value'], 2) }}</h4>
            <p>Inventory Value</p>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card p-4">
            <h5>Monthly Orders</h5>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-4">
            <h5>Financial Overview</h5>
            <canvas id="financeChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const ordersData = months.map((m, i) => {{ $monthlyOrders[(i+1)] ?? 0 }});

new Chart(document.getElementById('ordersChart'), {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{ label: 'Orders', data: ordersData, backgroundColor: '#4f46e5' }]
    }
});

new Chart(document.getElementById('financeChart'), {
    type: 'doughnut',
    data: {
        labels: ['Revenue', 'Profit', 'Expenses'],
        datasets: [{
            data: [{{ $stats['revenue'] }}, {{ $stats['profit'] }}, {{ $stats['expenses'] }}],
            backgroundColor: ['#28a745', '#17a2b8', '#dc3545']
        }]
    }
});
</script>
@endsection
