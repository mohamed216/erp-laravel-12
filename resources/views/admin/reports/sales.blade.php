@extends('layout.app')
@section('title', 'Sales Report')
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row">
            <div class="col-md-4">
                <input type="date" name="from" value="{{ $from }}" class="form-control">
            </div>
            <div class="col-md-4">
                <input type="date" name="to" value="{{ $to }}" class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card p-4 bg-success text-white text-center">
            <h4>{{ number_format($totalSales, 2) }}</h4>
            <p>Total Sales</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 bg-info text-white text-center">
            <h4>{{ $totalOrders }}</h4>
            <p>Total Orders</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 bg-warning text-center">
            <h4>{{ number_format($profit, 2) }}</h4>
            <p>Profit</p>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <table class="table">
            <tr><th>Order #</th><th>Date</th><th>Customer</th><th>Total</th></tr>
            @foreach($orders as $o)
            <tr>
                <td>{{ $o->order_number }}</td>
                <td>{{ $o->created_at->format('Y-m-d') }}</td>
                <td>{{ $o->customer?->name }}</td>
                <td>{{ $o->total_amount }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
