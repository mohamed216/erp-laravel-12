@extends('layout.app')
@section('title', 'Orders')
@section('content')
<div class="card">
    <div class="card-header"><a href="/orders/create" class="btn btn-primary btn-sm">+ New Order</a></div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $o)
                <tr>
                    <td><a href="/orders/{{ $o->id }}">{{ $o->order_number }}</a></td>
                    <td>{{ $o->customer?->name }}</td>
                    <td>${{ $o->total_amount }}</td>
                    <td>
                        @if($o->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($o->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @elseif($o->status == 'processing')
                            <span class="badge bg-info">Processing</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="/orders/{{ $o->id }}" class="btn btn-sm btn-primary">تعديل</a>
                        @if($o->status != 'completed')
                        <form method="POST" action="/orders/{{ $o->id }}" class="d-inline">@csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">X</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
