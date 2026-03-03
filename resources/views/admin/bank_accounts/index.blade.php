@extends('layout.app')
@section('title', 'Bank Accounts')
@section('content')
<div class="card">
    <div class="card-header"><h4>Bank Accounts</h4></div>
    <div class="card-body">
        <form method="POST" action="/bank-accounts" class="row mb-4">
            @csrf
            <div class="col-md-3"><input name="name" class="form-control" placeholder="Bank Name" required></div>
            <div class="col-md-3"><input name="account_number" class="form-control" placeholder="Account Number" required></div>
            <div class="col-md-3"><input name="iban" class="form-control" placeholder="IBAN"></div>
            <div class="col-md-2"><input name="balance" type="number" step="0.01" class="form-control" placeholder="Balance"></div>
            <div class="col-md-1"><button class="btn btn-primary w-100">Add</button></div>
        </form>
        <table class="table">
            <tr><th>Bank</th><th>Account #</th><th>IBAN</th><th>Balance</th><th></th></tr>
            @foreach($accounts as $a)
            <tr><td>{{ $a->name }}</td><td>{{ $a->account_number }}</td><td>{{ $a->iban }}</td><td>{{ number_format($a->balance, 2) }}</td>
            <td><form method="POST" action="/bank-accounts/{{ $a->id }}">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">X</button></form></td></tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
