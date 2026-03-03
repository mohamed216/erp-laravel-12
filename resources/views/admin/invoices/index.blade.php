@extends('layout.app')
@section('title', 'Invoices')
@section('content')
<div class="card">
    <div class="card-header"><a href="/invoices/create" class="btn btn-primary btn-sm">+ New Invoice</a></div>
    <div class="card-body">
        <table class="table">
            <tr><th>Invoice #</th><th>Customer</th><th>Total</th><th>Paid</th><th>Status</th><th></th></tr>
            @foreach($invoices as $inv)
            <tr>
                <td>{{ $inv->invoice_number }}</td>
                <td>{{ $inv->customer?->name }}</td>
                <td>{{ $inv->total_amount }}</td>
                <td>{{ $inv->paid_amount }}</td>
                <td><span class="badge bg-{{ $inv->status == 'paid' ? 'success' : 'warning' }}">{{ $inv->status }}</span></td>
                <td><a href="/invoices/{{ $inv->id }}" class="btn btn-sm btn-info">View</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
