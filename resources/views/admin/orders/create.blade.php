@extends('layout.app')
@section('title', 'Create Order')
@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="/orders">@csrf
            
            <!-- Customer Selection -->
            <div class="mb-4">
                <label class="form-label"><strong>Select Customer</strong></label>
                <input type="text" id="customerSearch" class="form-control mb-2" placeholder="Search customer...">
                <select name="customer_id" id="customerSelect" class="form-control" required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $c)
                    <option value="{{ $c->id }}" data-name="{{ strtolower($c->name) }}">{{ $c->name }} - {{ $c->email }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Products Selection -->
            <div class="mb-4">
                <label class="form-label"><strong>Select Products</strong></label>
                <input type="text" id="productSearch" class="form-control mb-2" placeholder="Search products...">
                <table class="table table-bordered" id="productsTable">
                    <thead>
                        <tr>
                            <th style="width:50px">✓</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $p)
                        <tr data-name="{{ strtolower($p->name) }}">
                            <td><input type="checkbox" name="products[]" value="{{ $p->id }}" class="product-check"></td>
                            <td>{{ $p->name }}</td>
                            <td>${{ $p->price }}</td>
                            <td>{{ $p->inventory?->stock_quantity ?? 0 }}</td>
                            <td><input type="number" name="quantities[{{ $p->id }}]" value="1" min="1" style="width:60px" class="form-control form-control-sm" disabled></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <button class="btn btn-primary">Create Order</button>
        </form>
    </div>
</div>

<script>
document.getElementById('customerSearch').addEventListener('keyup', function() {
    let search = this.value.toLowerCase();
    let options = document.querySelectorAll('#customerSelect option');
    options.forEach(opt => {
        let name = opt.getAttribute('data-name') || '';
        opt.style.display = name.includes(search) ? '' : 'none';
    });
});

document.getElementById('productSearch').addEventListener('keyup', function() {
    let search = this.value.toLowerCase();
    let rows = document.querySelectorAll('#productsTable tbody tr');
    rows.forEach(row => {
        let name = row.getAttribute('data-name') || '';
        row.style.display = name.includes(search) ? '' : 'none';
    });
});

document.querySelectorAll('.product-check').forEach(cb => {
    cb.addEventListener('change', function() {
        let qty = this.closest('tr').querySelector('input[type="number"]');
        qty.disabled = !this.checked;
    });
});
</script>
@endsection
