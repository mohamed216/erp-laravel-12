<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ERP System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar { background: #fff; min-height: 100vh; box-shadow: 2px 0 10px rgba(0,0,0,0.05); }
        .sidebar a { color: #333; padding: 15px 20px; display: block; text-decoration: none; border-radius: 8px; margin: 2px 8px; }
        .sidebar a:hover, .sidebar a.active { background: #4f46e5; color: #fff; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="p-3 border-bottom"><h5 class="m-0">🏢 ERP System</h5></div>
                <nav>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">📊 Dashboard</a>
                    <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">👥 Users</a>
                    <a href="/customers" class="{{ request()->is('customers*') ? 'active' : '' }}">👤 Customers</a>
                    <a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}">📦 Products</a>
                    <a href="/orders" class="{{ request()->is('orders*') ? 'active' : '' }}">🛒 Orders</a>
                    <a href="/inventory" class="{{ request()->is('inventory*') ? 'active' : '' }}">📈 Inventory</a>
                </nav>
            </div>
            <div class="col-md-10 p-4">
                <h4>@yield('page_title', 'Dashboard')</h4>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
