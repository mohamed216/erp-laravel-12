@extends('layout.app')
@section('title', 'Invoice')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Invoice #{{ $invoice->invoice_number }}</h4>
        <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : 'warning' }}">{{ $invoice->status }}</span>
    </div>
    <div class="card-body">
        <p><strong>Customer:</strong> {{ $invoice->customer?->name }}</p>
        <p><strong>Total:</strong> {{ $invoice->total_amount }}</p>
        <p><strong>Paid:</strong> {{ $invoice->paid_amount }}</p>
        <p><strong>Remaining:</strong> {{ $invoice->total_amount - $invoice->paid_amount }}</p>
        
        <hr>
        <h5>Payment</h5>
        <form method="POST" action="/invoices/{{ $invoice->id }}">@csrf @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <input name="paid_amount" type="number" step="0.01" class="form-control" value="{{ $invoice->paid_amount }}">
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success">Update Payment</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
