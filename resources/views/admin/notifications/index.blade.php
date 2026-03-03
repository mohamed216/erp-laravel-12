@extends('layout.app')
@section('title', 'Notifications')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Stock Alerts</h4>
    </div>
    <div class="card-body">
        @if($lowStock->count() == 0)
            <div class="alert alert-success">All products are well stocked!</div>
        @else
            @foreach($lowStock as $p)
            <div class="alert alert-warning d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $p->name }}</strong>
                    <br>
                    <small>Current Stock: {{ $p->inventory?->stock_quantity ?? 0 }}</small>
                </div>
                <span class="badge bg-danger">Low Stock</span>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
