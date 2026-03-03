@extends('layout.app')
@section('title', 'Notifications')
@section('content')
<style>
.alert-item { padding: 15px 20px; border-radius: 12px; margin-bottom: 10px; color: white; }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4><i class="fas fa-bell"></i> Stock Alerts</h4>
                <button class="btn btn-sm btn-primary" onclick="location.reload()"><i class="fas fa-sync"></i> Refresh</button>
            </div>
            <div class="card-body">
                @if($lowStock->count() == 0)
                <div class="alert" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
                    <i class="fas fa-check-circle"></i> All products are well stocked!
                </div>
                @else
                @foreach($lowStock as $p)
                <div class="alert-item" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <div class="d-flex justify-content-between">
                        <div><i class="fas fa-exclamation-triangle"></i> <strong>{{ $p->name }}</strong></div>
                        <span class="badge bg-light text-dark">Stock: {{ $p->inventory?->stock_quantity ?? 0 }}</span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
