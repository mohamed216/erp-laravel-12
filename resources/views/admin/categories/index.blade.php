@extends('layout.app')
@section('title', 'Categories')
@section('content')
<div class="card">
    <div class="card-header">
        <form method="POST" action="/categories" class="d-flex gap-2">
            @csrf
            <input name="name" class="form-control" placeholder="Category name" required>
            <button class="btn btn-primary">Add</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table">
            <tr><th>ID</th><th>Name</th><th>Actions</th></tr>
            @foreach($categories as $c)
            <tr><td>{{ $c->id }}</td><td>{{ $c->name }}</td>
            <td><form method="POST" action="/categories/{{ $c->id }}">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">X</button></form></td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
