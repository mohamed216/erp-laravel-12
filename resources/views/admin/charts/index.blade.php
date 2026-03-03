@extends('layout.app')
@section('title', 'Analytics')
@section('content')
<style>
.chart-container { height: 300px; }
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header"><h5>Monthly Revenue</h5></div>
            <div class="card-body chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header"><h5>Orders by Status</h5></div>
            <div class="card-body chart-container">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header"><h5>Top Products</h5></div>
    <div class="card-body">
        <table class="table">
            <tr><th>Product</th><th>Quantity Sold</th></tr>
            @foreach($topProducts as $p)
            <tr><td>{{ $p->name }}</td><td><span class="badge bg-primary">{{ $p->total_qty }}</span></td></tr>
            @endforeach
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{ label: 'Revenue', data: @json($revenueData), borderColor: '#4361ee', backgroundColor: 'rgba(67,97,238,0.1)', fill: true }]
    }
});
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
        datasets: [{ data: @json(array_values($orderStatus)), backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'] }]
    }
});
</script>
@endsection
