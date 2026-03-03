@extends('layout.app')
@section('title', 'Notifications')
@section('content')
<style>
.notification-item {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 15px;
    animation: slideIn 0.3s ease;
}
@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}
.notif-success { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.notif-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.notif-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
.notif-info { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
</style>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h5>Real-time Alerts</h5></div>
            <div class="card-body" id="notifications">
                <div class="notification-item notif-info">
                    <i class="fas fa-info-circle"></i>
                    <span>Connecting to notifications...</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4>Low Stock Products</h4></div>
            <div class="card-body">
                @if($lowStock->count() == 0)
                    <div class="alert alert-success">All products are well stocked!</div>
                @else
                    @foreach($lowStock as $p)
                    <div class="alert alert-warning d-flex justify-content-between">
                        <div><strong>{{ $p->name }}</strong><br><small>Current: {{ $p->inventory?->stock_quantity ?? 0 }}</small></div>
                        <span class="badge bg-danger">Low</span>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script>
const notifDiv = document.getElementById('notifications');

function addNotification(type, message) {
    const div = document.createElement('div');
    div.className = 'notification-item notif-' + type;
    div.innerHTML = '<i class="fas fa-' + (type === 'danger' ? 'exclamation-triangle' : (type === 'warning' ? 'box' : 'info-circle')) + '"></i><span>' + message + '</span>';
    notifDiv.insertBefore(div, notifDiv.firstChild);
    
    // Keep only last 5 notifications
    while (notifDiv.children.length > 5) {
        notifDiv.removeChild(notifDiv.lastChild);
    }
}

// Connect to SSE
const eventSource = new EventSource('/notifications/stream');

eventSource.onmessage = function(event) {
    const data = JSON.parse(event.data);
    
    if (data.type === 'low_stock') {
        addNotification('danger', data.message);
    }
};

eventSource.onerror = function() {
    addNotification('warning', 'Connection lost. Reconnecting...');
    setTimeout(() => location.reload(), 5000);
};
</script>
@endsection
