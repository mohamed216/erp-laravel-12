<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/print.css" rel="stylesheet">
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <div>
                <div class="invoice-title">INVOICE</div>
                <p>#{{ $invoice->invoice_number }}</p>
            </div>
            <div class="text-end">
                <img src="/images/logo.svg" height="40" class="me-2"><h4>ERP System</h4>
                <p>Date: {{ $invoice->created_at->format('Y-m-d') }}</p>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <strong>Bill To:</strong>
                <p>{{ $invoice->customer?->name }}<br>{{ $invoice->customer?->email }}</p>
            </div>
        </div>
        
        <table class="table table-bordered">
            <thead class="table-light">
                <tr><th>Description</th><th>Amount</th></tr>
            </thead>
            <tbody>
                <tr><td>Order #{{ $invoice->order?->order_number }}</td><td>{{ number_format($invoice->total_amount, 2) }}</td></tr>
            </tbody>
            <tfoot>
                <tr><th>Total</th><th>{{ number_format($invoice->total_amount, 2) }}</th></tr>
                <tr><th>Paid</th><th>{{ number_format($invoice->paid_amount, 2) }}</th></tr>
                <tr><th>Balance</th><th>{{ number_format($invoice->total_amount - $invoice->paid_amount, 2) }}</th></tr>
            </tfoot>
        </table>
        
        <div class="text-center mt-5">
            <button class="btn btn-primary no-print" onclick="window.print()">Print Invoice</button>
            <a href="/invoices" class="btn btn-secondary no-print">Back</a>
        </div>
    </div>
</body>
</html>
