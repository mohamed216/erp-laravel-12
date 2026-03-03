@extends('layout.app')
@section('title', 'Notifications')
@section('content')
<style>
.alert-item {
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 10px;
    color: white;
}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4><i class="fas fa-bell"></i> Stock Alerts</h4>
                <button class="btn btn-sm btn-primary" onclick="location.reload()">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </div>
            <div class="card-body">
                @if($lowStock->count() == 0)
                    <div class="alert alert-success" style="background: linear-gradient(135deg, #10b981, #059669); color: white;">
                        <i class="fas fa-check-circle"></i> All products are well stocked!
                    </div>
                @else
                    @foreach($lowStock as $p)
                    <div class="alert-item" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>{{ $p->name }}</strong>
                            </div>
                            <div>
                                <span class="badge bg-white text-warning">Stock: {{ $p->inventory?->stock_quantity ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Real-time Notifications (Auto-refresh)</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    <i class="fas fa-info-circle"></i> 
                    This page will automatically check for new alerts every 30 seconds.
                </p>
                <button class="btn btn-success" onclick="startAutoRefresh()">
                    <i class="fas fa-play"></i> Start Auto-refresh
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function startAutoRefresh() {
    setInterval(() => {
        location.reload();
    }, 30000); // Refresh every 30 seconds
}
startAutoRefresh();
</script>
@endsection
