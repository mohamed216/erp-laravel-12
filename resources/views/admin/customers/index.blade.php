@extends('layout.app')
@section('title', 'Customers')
@section('content')
<div class="card">
    <div class="card-header"><a href="/customers/create" class="btn btn-primary btn-sm">+ Add</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
            @foreach(customers as c)
            <tr><td>{{ c->name }}</td><td>{{ c->email }}</td><td>{{ c->phone }}</td>
            <td><a href="/customers/{{ c->id }}/edit" class="btn btn-sm btn-warning">Edit</a></td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
