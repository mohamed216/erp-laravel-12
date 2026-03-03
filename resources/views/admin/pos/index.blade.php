@extends('layout.app')
@section('title', 'POS')
@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <input type="text" id="search" class="form-control" placeholder="Search products...">
            </div>
            <div class="card-body">
                <div class="row" id="products-grid">
                    @foreach($products as $p)
                    <div class="col-md-4 mb-3 product-item" data-name="{{ strtolower($p->name) }}">
                        <div class="card p-3 text-center cursor-pointer" onclick="addToCart({{ $p->id }}, '{{ $p->name }}', {{ $p->price }})">
                            <h6>{{ $p->name }}</h6>
                            <p class="text-success">{{ $p->price }}</p>
                            <small>Stock: {{ $p->inventory?->stock_quantity ?? 0 }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h5>Cart</h5>
            </div>
            <div class="card-body">
                <select id="customer" class="form-control mb-3">
                    <option value="">Select Customer</option>
                    @foreach($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
                <table class="table" id="cart-table">
                    <tr><th>Product</th><th>Qty</th><th>Price</th><th></th></tr>
                </table>
                <h4>Total: <span id="total">0</span></h4>
                <button class="btn btn-success w-100" onclick="checkout()">Complete Sale</button>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];

function addToCart(id, name, price) {
    let existing = cart.find(item => item.id === id);
    if (existing) {
        existing.qty++;
    } else {
        cart.push({id, name, price, qty: 1});
    }
    renderCart();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
}

function renderCart() {
    let html = '<tr><th>Product</th><th>Qty</th><th>Price</th><th></th></tr>';
    let total = 0;
    cart.forEach(item => {
        let subtotal = item.price * item.qty;
        total += subtotal;
        html += `<tr>
            <td>${item.name}</td>
            <td><input type="number" value="${item.qty}" min="1" onchange="updateQty(${item.id}, this.value)" style="width:50px"></td>
            <td>${subtotal}</td>
            <td><button class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">X</button></td>
        </tr>`;
    });
    document.getElementById('cart-table').innerHTML = html;
    document.getElementById('total').innerText = total;
}

function updateQty(id, qty) {
    let item = cart.find(i => i.id === id);
    if (item) item.qty = parseInt(qty);
    renderCart();
}

function checkout() {
    if (cart.length === 0) return alert('Cart is empty');
    let customer = document.getElementById('customer').value;
    if (!customer) return alert('Select customer');
    
    fetch('/pos/create', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ customer_id: customer, items: cart })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Sale completed!');
            location.reload();
        }
    });
}

document.getElementById('search').addEventListener('keyup', function() {
    let search = this.value.toLowerCase();
    document.querySelectorAll('.product-item').forEach(el => {
        el.style.display = el.dataset.name.includes(search) ? 'block' : 'none';
    });
});
</script>
@endsection
