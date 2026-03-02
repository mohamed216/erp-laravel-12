@extends('layout.app')
@section('title', 'Users')
@section('content')
<div class="card">
    <div class="card-header"><a href="/users/create" class="btn btn-primary btn-sm">+ Add</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge bg-danger">{{ $user->role }}</span></td>
                <td>
                    <a href="/users/{{ $user->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
