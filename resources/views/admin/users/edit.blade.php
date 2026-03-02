@extends('layout.app')
@section('title', 'Edit User')
@section('content')
<form method="POST" action="/users/{{ $user->id }}">@csrf @method('PUT')
<input name="name" value="{{ $user->name }}" class="form-control mb-2">
<input name="email" value="{{ $user->email }}" class="form-control mb-2">
<input name="password" type="password" class="form-control mb-2" placeholder="New Password">
<button class="btn btn-primary">Update</button>
</form>
@endsection
