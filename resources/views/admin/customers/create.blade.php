@extends('layout.app')
@section('title', 'Create Customer')
@section('content')
<form method="POST" action="/customers">@csrf
<input name="name" class="form-control mb-2" placeholder="Name" required>
<input name="email" class="form-control mb-2" placeholder="Email">
<input name="phone" class="form-control mb-2" placeholder="Phone">
<button class="btn btn-primary">Create</button>
</form>
@endsection
