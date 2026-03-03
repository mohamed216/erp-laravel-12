@extends('layout.app')
@section('title', 'Suppliers')
@section('content')
<div class="card mb-4">
    <div class="card-header">Add Supplier</div>
    <div class="card-body">
        <form method="POST" action="/suppliers" class="row">
            @csrf
            <div class="col-md-3">
                <input name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-3">
                <input name="email" type="email" class="form-control" placeholder="Email">
            </div>
            <div class="col-md-3">
                <input name="phone" class="form-control" placeholder="Phone">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100">Add</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th></th></tr>
            @foreach($suppliers as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->email }}</td>
                <td>{{ $s->phone }}</td>
                <td>
                    <form method="POST" action="/suppliers/{{ $s->id }}">@csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
