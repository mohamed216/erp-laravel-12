@extends('layout.app')
@section('title', 'Create Order')
@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="/orders">@csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Customer</label>
                    <select name="customer_id" class="form-control" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <h5>Products</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td><input type="checkbox" name="products[]" value="{{ $p->id }}"></td>
                        <td>{{ $p->name }}</td>
                        <td>${{ $p->price }}</td>
                        <td>{{ $p->inventory?->stock_quantity ?? 0 }}</td>
                        <td><input type="number" name="quantities[{{ $p->id }}]" value="1" min="1" style="width:60px"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <button class="btn btn-primary">Create Order</button>
        </form>
    </div>
</div>
@endsection
