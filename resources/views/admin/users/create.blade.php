@extends('layout.app')
@section('title', 'Create User')
@section('content')
<form method="POST" action="/users">@csrf
<input name="name" class="form-control mb-2" placeholder="Name" required>
<input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
<input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
<select name="role" class="form-control mb-2"><option>Admin</option><option>Manager</option><option>Employee</option></select>
<button class="btn btn-primary">Create</button>
</form>
@endsection
