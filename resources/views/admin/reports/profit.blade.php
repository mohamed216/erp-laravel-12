@extends('layout.app')
@section('title', 'Profit Report')
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
    <div class="col-md-3">
        <div class="card p-4 bg-success text-white text-center">
            <h4>{{ number_format($revenue, 2) }}</h4>
            <p>Revenue</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 bg-warning text-center">
            <h4>{{ number_format($cost, 2) }}</h4>
            <p>Cost</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 bg-info text-white text-center">
            <h4>{{ number_format($profit, 2) }}</h4>
            <p>Gross Profit</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 bg-danger text-white text-center">
            <h4>{{ number_format($netProfit, 2) }}</h4>
            <p>Net Profit</p>
        </div>
    </div>
</div>
@endsection
