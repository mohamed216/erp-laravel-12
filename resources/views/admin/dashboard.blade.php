@extends('layout.app')
@section('title', 'Dashboard')
@section('page_title', __('dashboard'))
@section('content')

<div class="row mt-4">
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['users'] }}</h5><small>@lang('users')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['customers'] }}</h5><small>@lang('customers')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['products'] }}</h5><small>@lang('products')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ $stats['orders'] }}</h5><small>@lang('orders')</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ number_format($stats['revenue'], 0) }}</h5><small>Revenue</small></div></div>
    <div class="col-md-2"><div class="card p-3 text-center"><h5>{{ number_format($stats['net_profit'], 0) }}</h5><small>Net Profit</small></div></div>
</div>

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

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card p-4">
            <h5>Financial Overview</h5>
            <canvas id="financeChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-4">
            <h5>Quick Stats</h5>
            <table class="table">
                <tr><td>Inventory Cost</td><td>{{ number_format($stats['inventory_cost'], 2) }}</td></tr>
                <tr><td>Inventory Value</td><td>{{ number_format($stats['inventory_value'], 2) }}</td></tr>
                <tr><td>Net Profit</td><td>{{ number_format($stats['net_profit'], 2) }}</td></tr>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
