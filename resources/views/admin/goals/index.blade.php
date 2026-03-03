@extends('layout.app')
@section('title', 'Sales Goals')
@section('content')
<style>.goal-card{border-radius:15px;padding:20px;color:white;margin-bottom:15px}.progress{height:20px;border-radius:10px}</style>
<div class="card mb-4">
    <div class="card-header"><h4>Add New Goal</h4></div>
    <div class="card-body">
        <form method="POST" action="/goals" class="row">
            @csrf
            <div class="col-md-3"><input name="title" class="form-control" placeholder="Goal Title" required></div>
            <div class="col-md-2"><input name="target" type="number" step="0.01" class="form-control" placeholder="Target" required></div>
            <div class="col-md-2"><select name="period" class="form-control"><option value="monthly">Monthly</option><option value="yearly">Yearly</option></select></div>
            <div class="col-md-2"><input name="start_date" type="date" class="form-control"></div>
            <div class="col-md-2"><input name="end_date" type="date" class="form-control"></div>
            <div class="col-md-1"><button class="btn btn-primary w-100">Add</button></div>
        </form>
    </div>
</div>
<div class="row">
    @foreach($goals as $g)
    <?php $percent = min(100, ($g->current / $g->target) * 100); ?>
    <div class="col-md-6">
        <div class="goal-card" style="background: linear-gradient(135deg, {{ $g->achieved ? '#10b981' : '#4361ee' }}, {{ $g->achieved ? '#059669' : '#3730a3' }})">
            <div class="d-flex justify-content-between align-items-center">
                <h5>{{ $g->title }}</h5>
                @if($g->achieved)<span class="badge bg-white text-success"><i class="fas fa-trophy"></i> Achieved</span>@endif
            </div>
            <h2>{{ number_format($g->current) }} / {{ number_format($g->target) }}</h2>
            <div class="progress">
                <div class="progress-bar bg-white" style="width:{{ $percent }}%"></div>
            </div>
            <small>{{ $percent }}% Complete</small>
            <form method="POST" action="/goals/{{ $g->id }}" class="mt-2 d-flex gap-2">
                @csrf @method('PUT')
                <input name="current" type="number" step="0.01" class="form-control form-control-sm" placeholder="Update Progress" value="{{ $g->current }}">
                <button class="btn btn-sm btn-light">Update</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
