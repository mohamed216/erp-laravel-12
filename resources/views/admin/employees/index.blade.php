@extends('layout.app')
@section('title', 'Employees')
@section('content')
<div class="card">
    <div class="card-header"><h4>Employees</h4></div>
    <div class="card-body">
        <form method="POST" action="/employees" class="row mb-4">
            @csrf
            <div class="col-md-2"><input name="name" class="form-control" placeholder="Name" required></div>
            <div class="col-md-2"><input name="email" type="email" class="form-control" placeholder="Email"></div>
            <div class="col-md-2"><input name="phone" class="form-control" placeholder="Phone"></div>
            <div class="col-md-2"><input name="position" class="form-control" placeholder="Position"></div>
            <div class="col-md-2"><input name="salary" type="number" step="0.01" class="form-control" placeholder="Salary"></div>
            <div class="col-md-1"><input name="hire_date" type="date" class="form-control"></div>
            <div class="col-md-1"><button class="btn btn-primary w-100">Add</button></div>
        </form>
        <table class="table">
            <tr><th>Name</th><th>Email</th><th>Phone</th><th>Position</th><th>Salary</th><th>Hire Date</th><th></th></tr>
            @foreach($employees as $e)
            <tr><td>{{ $e->name }}</td><td>{{ $e->email }}</td><td>{{ $e->phone }}</td><td>{{ $e->position }}</td><td>{{ $e->salary }}</td><td>{{ $e->hire_date }}</td>
            <td><form method="POST" action="/employees/{{ $e->id }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">X</button></form></td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
