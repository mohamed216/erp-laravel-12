<!DOCTYPE html>
<html lang="{{ session('locale', 'ar') }}" dir="{{ session('locale', 'ar') == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'ERP System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @if(session('locale', 'ar') == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root { --primary: #4361ee; --secondary: #3730a3; }
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; margin: 0; }
        .navbar-custom { background: linear-gradient(135deg, var(--primary), var(--secondary)); padding: 12px 20px; }
        .navbar-custom .navbar-brand { color: white; font-weight: bold; }
        .sidebar-custom { background: white; min-height: 100vh; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .sidebar-custom .menu-item { padding: 12px 20px; color: var(--dark); text-decoration: none; display: block; border-left: 3px solid transparent; transition: 0.3s; font-size: 14px; }
        .sidebar-custom .menu-item:hover, .sidebar-custom .menu-item.active { background: #f8f9fa; border-left-color: var(--primary); color: var(--primary); }
        .user-badge { background: rgba(255,255,255,0.2); padding: 5px 12px; border-radius: 20px; color: white; }
        .custom-alert { padding: 16px 20px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; animation: slideIn 0.4s ease; border: none; }
        .custom-alert i { font-size: 20px; }
        .alert-success-custom { background: linear-gradient(135deg, #10b981, #059669); color: white; }
        .alert-error-custom { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
        @keyframes slideIn { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar-toggle { display: block !important; }
            .sidebar-custom { display: none; position: fixed; z-index: 1000; width: 70%; }
            .sidebar-custom.show { display: block; }
            .col-md-10 { width: 100% !important; }
            .stat-card { margin-bottom: 10px; }
            .stat-card h2 { font-size: 20px; }
            .hide-mobile { display: none !important; }
            .table { font-size: 12px; }
        }
        .sidebar-toggle { display: none; }
    </style>
</head>
<body>
    @auth
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <button class="sidebar-toggle btn btn-light" onclick="document.querySelector('.sidebar-custom').classList.toggle('show')">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/dashboard"><img src="/images/logo.svg" height="30" class="me-2">ERP</a>
            <div class="d-flex align-items-center gap-2">
                <a href="/setlang/en" class="user-badge text-decoration-none {{ session('locale') != 'ar' ? 'bg-warning text-dark' : '' }}">EN</a>
                <a href="/setlang/ar" class="user-badge text-decoration-none {{ session('locale') == 'ar' ? 'bg-warning text-dark' : '' }}">ع</a>
                <form method="POST" action="/logout">@csrf<button type="submit" class="btn btn-sm btn-light"><i class="fas fa-sign-out-alt"></i></button></form>
            </div>
        </div>
    </nav>
    @endauth
    <div class="container-fluid">
        <div class="row">
            @auth
            <?php $role = auth()->user()->role; ?>
            <div class="col-md-2 sidebar-custom p-0">
                <nav class="mt-3">
                    <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
                    <a href="/notifications" class="menu-item {{ request()->is('notifications*') ? 'active' : '' }}"><i class="fas fa-bell"></i> Alerts</a>
                    <a href="/pos" class="menu-item {{ request()->is('pos*') ? 'active' : '' }}"><i class="fas fa-cash-register"></i> POS</a>
                    @if($role == 'admin')
                    <a href="/users" class="menu-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i> Users</a>
                    <a href="/settings" class="menu-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a>
                    @endif
                    @if(in_array($role, ['admin', 'manager']))
                    <a href="/customers" class="menu-item {{ request()->is('customers*') ? 'active' : '' }}"><i class="fas fa-user-tie"></i> Customers</a>
                    <a href="/products" class="menu-item {{ request()->is('products*') ? 'active' : '' }}"><i class="fas fa-box"></i> Products</a>
                    <a href="/orders" class="menu-item {{ request()->is('orders*') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> Orders</a>
                    <a href="/invoices" class="menu-item {{ request()->is('invoices*') ? 'active' : '' }}"><i class="fas fa-file-invoice"></i> Invoices</a>
                    <a href="/expenses" class="menu-item {{ request()->is('expenses*') ? 'active' : '' }}"><i class="fas fa-money-bill"></i> Expenses</a>
                    @endif
                    <a href="/inventory" class="menu-item {{ request()->is('inventory*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> Inventory</a>
                </nav>
            </div>
            @endauth
            <div class="{{ auth()->check() ? 'col-md-10' : 'col-md-12' }} p-3">
                @if(session('success'))<div class="custom-alert alert-success-custom"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>@endif
                @if(session('error'))<div class="custom-alert alert-error-custom"><i class="fas fa-exclamation-circle"></i><span>{{ session('error') }}</span></div>@endif
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
