@extends('layout.app')
@section('title', 'Users')
@section('content')
<div class="card">
    <div class="card-header"><a href="/users/create" class="btn btn-primary btn-sm">+ Add</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr>
            @foreach($users as u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td><span class="badge bg-{{ $$u->role=='Admin'?'danger':'info' }}">{{ $u->role }}</span></td>
                <td>
                    <a href="/users/{{ $u->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
