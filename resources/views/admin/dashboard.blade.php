@extends('layout.app')
@section('title', 'Dashboard')
@section('page_title', session('locale') == 'en' ? 'Dashboard' : 'لوحة التحكم')
@section('content')

<style>
.stat-card { border-radius: 15px; padding: 20px; color: white; transition: 0.3s; }
.stat-card:hover { transform: translateY(-5px); }
.stat-card h2 { font-size: 28px; font-weight: bold; margin: 0; }
.stat-card p { margin: 5px 0 0 0; opacity: 0.9; }
.stat-icon { font-size: 40px; opacity: 0.3; position: absolute; right: 20px; top: 20px; }
</style>

<div class="row g-3 mb-4">
    <div class="col-md-2"><div class="stat-card bg-primary position-relative" style="background: linear-gradient(135deg, #4361ee, #3730a3)!important"><i class="fas fa-users stat-icon"></i><h2>{{ $stats['users'] }}</h2><p>Users</p></div></div>
    <div class="col-md-2"><div class="stat-card bg-info position-relative" style="background: linear-gradient(135deg, #0ea5e9, #0369a1)!important"><i class="fas fa-user-tie stat-icon"></i><h2>{{ $stats['customers'] }}</h2><p>Customers</p></div></div>
    <div class="col-md-2"><div class="stat-card bg-success position-relative" style="background: linear-gradient(135deg, #10b981, #047857)!important"><i class="fas fa-box stat-icon"></i><h2>{{ $stats['products'] }}</h2><p>Products</p></div></div>
    <div class="col-md-2"><div class="stat-card bg-warning position-relative" style="background: linear-gradient(135deg, #f59e0b, #b45309)!important"><i class="fas fa-shopping-cart stat-icon"></i><h2>{{ $stats['orders'] }}</h2><p>Orders</p></div></div>
    <div class="col-md-2"><div class="stat-card bg-danger position-relative" style="background: linear-gradient(135deg, #f43f5e, #be123c)!important"><i class="fas fa-user-tie stat-icon"></i><h2>{{ $stats['employees'] }}</h2><p>Employees</p></div></div>
    <div class="col-md-2"><div class="stat-card bg-secondary position-relative" style="background: linear-gradient(135deg, #6366f1, #4338ca)!important"><i class="fas fa-truck stat-icon"></i><h2>{{ $stats['suppliers'] }}</h2><p>Suppliers</p></div></div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3"><div class="stat-card bg-success position-relative" style="background: linear-gradient(135deg, #22c55e, #15803d)!important"><i class="fas fa-money-bill stat-icon"></i><h2>{{ number_format($stats['revenue'], 0) }}</h2><p>Revenue</p></div></div>
    <div class="col-md-3"><div class="stat-card bg-info position-relative" style="background: linear-gradient(135deg, #06b6d4, #0e7490)!important"><i class="fas fa-chart-line stat-icon"></i><h2>{{ number_format($stats['profit'], 0) }}</h2><p>Gross Profit</p></div></div>
    <div class="col-md-3"><div class="stat-card bg-warning position-relative" style="background: linear-gradient(135deg, #eab308, #a16207)!important"><i class="fas fa-money-bill-wave stat-icon"></i><h2>{{ number_format($stats['expenses'], 0) }}</h2><p>Expenses</p></div></div>
    <div class="col-md-3"><div class="stat-card bg-primary position-relative" style="background: linear-gradient(135deg, #8b5cf6, #6d28d9)!important"><i class="fas fa-university stat-icon"></i><h2>{{ number_format($stats['bank_balance'], 0) }}</h2><p>Bank Balance</p></div></div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5>Inventory Overview</h5></div>
            <div class="card-body">
                <table class="table">
                    <tr><td>Inventory Cost</td><td><strong>{{ number_format($stats['inventory_cost'], 2) }}</strong></td></tr>
                    <tr><td>Inventory Value</td><td><strong>{{ number_format($stats['inventory_value'], 2) }}</strong></td></tr>
                    <tr><td>Potential Profit</td><td><strong class="text-success">{{ number_format($stats['inventory_value'] - $stats['inventory_cost'], 2) }}</strong></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5>Quick Stats</h5></div>
            <div class="card-body">
                <table class="table">
                    <tr><td>Net Profit</td><td><strong class="text-{{ $stats['net_profit'] >= 0 ? 'success' : 'danger' }}">{{ number_format($stats['net_profit'], 2) }}</strong></td></tr>
                    <tr><td<td>Total Orders><strong>{{ $stats['orders'] }}</strong></td></tr>
                    <tr><td>Customers</td><td><strong>{{ $stats['customers'] }}</strong></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
