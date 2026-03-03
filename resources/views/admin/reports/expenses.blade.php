@extends('layout.app')
@section('title', 'Expenses Report')
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

<div class="card p-4 bg-danger text-white text-center mb-4">
    <h4>{{ number_format($total, 2) }}</h4>
    <p>Total Expenses</p>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <tr><th>Date</th><th>Title</th><th>Category</th><th>Amount</th></tr>
            @foreach($expenses as $e)
            <tr>
                <td>{{ $e->date }}</td>
                <td>{{ $e->title }}</td>
                <td>{{ $e->category }}</td>
                <td>{{ $e->amount }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
