@extends('layout.app')
@section('title', 'Expenses')
@section('content')
<div class="card mb-4">
    <div class="card-header">Add Expense</div>
    <div class="card-body">
        <form method="POST" action="/expenses" class="row">
            @csrf
            <div class="col-md-3">
                <input name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="col-md-2">
                <input name="amount" type="number" step="0.01" class="form-control" placeholder="Amount" required>
            </div>
            <div class="col-md-2">
                <select name="category" class="form-control">
                    <option>Rent</option>
                    <option>Salary</option>
                    <option>Utilities</option>
                    <option>Supplies</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="col-md-3">
                <input name="date" type="date" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Add</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <span>Expenses</span>
        <span class="badge bg-danger">Total: {{ $total }}</span>
    </div>
    <div class="card-body">
        <table class="table">
            <tr><th>Date</th><th>Title</th><th>Category</th><th>Amount</th><th></th></tr>
            @foreach($expenses as $e)
            <tr>
                <td>{{ $e->date }}</td>
                <td>{{ $e->title }}</td>
                <td>{{ $e->category }}</td>
                <td>{{ $e->amount }}</td>
                <td>
                    <form method="POST" action="/expenses/{{ $e->id }}">@csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
