@extends('layout.app')
@section('title', 'Edit Customer')
@section('content')
<form method="POST" action="/customers/{{ customer->id }}">@csrf @method('PUT')
<input name="name" value="{{ customer->name }}" class="form-control mb-2">
<button class="btn btn-primary">Update</button>
</form>
@endsection
