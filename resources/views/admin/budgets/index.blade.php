@extends('layout.app')
@section('title', 'Budget')
@section('content')
<div class="card mb-4">
    <div class="card-header"><h4>Add Budget</h4></div>
    <div class="card-body">
        <form method="POST" action="/budgets" class="row">
            @csrf
            <div class="col-md-2"><input name="year" type="number" class="form-control" value="{{ date('Y') }}" placeholder="Year"></div>
            <div class="col-md-2"><input name="month" type="number" class="form-control" value="{{ date('m') }}" placeholder="Month"></div>
            <div class="col-md-3"><select name="category" class="form-control"><option>Salary</option><option>Rent</option><option>Utilities</option><option>Marketing</option><option>Other</option></select></div>
            <div class="col-md-3"><input name="amount" type="number" step="0.01" class="form-control" placeholder="Amount"></div>
            <div class="col-md-2"><button class="btn btn-primary w-100">Add</button></div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header"><h4>Budgets</h4></div>
    <div class="card-body">
        <table class="table">
            <tr><th>Year</th><th>Month</th><th>Category</th><th>Budget</th><th>Spent</th><th>Remaining</th><th></th></tr>
            @foreach($budgets as $b)
            <?php $remaining = $b->amount - $b->spent; ?>
            <tr>
                <td>{{ $b->year }}</td>
                <td>{{ $b->month }}</td>
                <td>{{ $b->category }}</td>
                <td>{{ number_format($b->amount, 2) }}</td>
                <td>{{ number_format($b->spent, 2) }}</td>
                <td class="{{ $remaining < 0 ? 'text-danger' : 'text-success' }}">{{ number_format($remaining, 2) }}</td>
                <td><form method="POST" action="/budgets/{{ $b->id }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">X</button></form></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
