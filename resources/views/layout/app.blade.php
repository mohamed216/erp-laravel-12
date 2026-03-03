<!DOCTYPE html>
<html lang="{{ session('locale', 'ar') }}" dir="{{ session('locale', 'ar') == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ERP System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @if(session('locale', 'ar') == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root { --primary: #4361ee; --secondary: #3f37c9; }
        body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .navbar-custom { background: linear-gradient(135deg, var(--primary), var(--secondary)); padding: 12px 20px; }
        .navbar-custom .navbar-brand { color: white; font-weight: bold; }
        .sidebar-custom { background: white; min-height: 100vh; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .sidebar-custom .menu-item { padding: 12px 20px; color: var(--dark); text-decoration: none; display: block; border-left: 3px solid transparent; transition: 0.3s; }
        .sidebar-custom .menu-item:hover, .sidebar-custom .menu-item.active { background: #f8f9fa; border-left-color: var(--primary); color: var(--primary); }
        .user-badge { background: rgba(255,255,255,0.2); padding: 5px 12px; border-radius: 20px; color: white; }
        
        .custom-alert { padding: 16px 20px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; animation: slideIn 0.4s ease; border: none; }
        .custom-alert i { font-size: 20px; }
        .custom-alert .btn-close { filter: invert(1); opacity: 0.7; }
        .alert-success-custom { background: linear-gradient(135deg, #10b981, #059669); color: white; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
        .alert-error-custom { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); }
        .alert-warning-custom { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); }
        .alert-info-custom { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); }
        @keyframes slideIn { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    </style>
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard"><i class="fas fa-building"></i> ERP System</a>
            <div class="d-flex align-items-center gap-3">
                <a href="/setlang/en" class="user-badge text-decoration-none {{ session('locale') != 'ar' ? 'bg-warning text-dark' : '' }}">EN</a>
                <a href="/setlang/ar" class="user-badge text-decoration-none {{ session('locale') == 'ar' ? 'bg-warning text-dark' : '' }}">العربية</a>
                <span class="user-badge"><i class="fas fa-user"></i> {{ auth()->user()->name }}</span>
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
                    <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> {{ session('locale') == 'en' ? 'Dashboard' : 'الرئيسية' }}</a>
                    <a href="/notifications" class="menu-item {{ request()->is('notifications*') ? 'active' : '' }}"><i class="fas fa-bell"></i> {{ session('locale') == 'en' ? 'Alerts' : 'التنبيهات' }}</a>
                    <a href="/pos" class="menu-item {{ request()->is('pos*') ? 'active' : '' }}"><i class="fas fa-cash-register"></i> {{ session('locale') == 'en' ? 'POS' : 'نقطة البيع' }}</a>
                    <a href="/bank-accounts" class="menu-item {{ request()->is("bank-accounts*") ? "active" : "" }}"><i class="fas fa-university"></i> {{ session("locale") == "en" ? "Banks" : "البنوك" }}</a>
                    <a href="/backup" class="menu-item {{ request()->is('backup*') ? 'active' : '' }}"><i class="fas fa-database"></i> {{ session('locale') == 'en' ? 'Backup' : 'النسخ' }}</a>
                    @if($role == 'admin')
                    <div class="mt-3 px-3 text-muted small">ADMIN</div>
                    <a href="/users" class="menu-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i> {{ session('locale') == 'en' ? 'Users' : 'المستخدمين' }}</a>
                    <a href="/settings" class="menu-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i> {{ session('locale') == 'en' ? 'Settings' : 'الإعدادات' }}</a>
                    @endif
                    @if(in_array($role, ['admin', 'manager']))
                    <div class="mt-3 px-3 text-muted small">MANAGEMENT</div>
                    <a href="/customers" class="menu-item {{ request()->is('customers*') ? 'active' : '' }}"><i class="fas fa-user-tie"></i> {{ session('locale') == 'en' ? 'Customers' : 'العملاء' }}</a>
                    <a href="/products" class="menu-item {{ request()->is('products*') ? 'active' : '' }}"><i class="fas fa-box"></i> {{ session('locale') == 'en' ? 'Products' : 'المنتجات' }}</a>
                    <a href="/categories" class="menu-item {{ request()->is('categories*') ? 'active' : '' }}"><i class="fas fa-tags"></i> {{ session('locale') == 'en' ? 'Categories' : 'التصنيفات' }}</a>
                    <a href="/suppliers" class="menu-item {{ request()->is('suppliers*') ? 'active' : '' }}"><i class="fas fa-truck"></i> {{ session('locale') == 'en' ? 'Suppliers' : 'الموردين' }}</a>
                    <a href="/invoices" class="menu-item {{ request()->is('invoices*') ? 'active' : '' }}"><i class="fas fa-file-invoice"></i> {{ session('locale') == 'en' ? 'Invoices' : 'الفواتير' }}</a>
                    <a href="/expenses" class="menu-item {{ request()->is('expenses*') ? 'active' : '' }}"><i class="fas fa-money-bill"></i> {{ session('locale') == 'en' ? 'Expenses' : 'المصروفات' }}</a>
                    <div class="mt-3 px-3 text-muted small">REPORTS</div>
                    <a href="/reports/sales" class="menu-item {{ request()->is('reports*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> {{ session('locale') == 'en' ? 'Reports' : 'التقارير' }}</a>
                    @endif
                    <div class="mt-3 px-3 text-muted small">OPERATIONS</div>
                    <a href="/orders" class="menu-item {{ request()->is('orders*') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> {{ session('locale') == 'en' ? 'Orders' : 'الطلبات' }}</a>
                    <a href="/inventory" class="menu-item {{ request()->is('inventory*') ? 'active' : '' }}"><i class="fas fa-warehouse"></i> {{ session('locale') == 'en' ? 'Inventory' : 'المخزون' }}</a>
                </nav>
            </div>
            @endauth
            <div class="{{ auth()->check() ? 'col-md-10' : 'col-md-12' }} p-4">
                @if(session('success'))<div class="custom-alert alert-success-custom"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span><button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button></div>@endif
                @if(session('error'))<div class="custom-alert alert-error-custom"><i class="fas fa-exclamation-circle"></i><span>{{ session('error') }}</span><button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button></div>@endif
                @if(session('warning'))<div class="custom-alert alert-warning-custom"><i class="fas fa-exclamation-triangle"></i><span>{{ session('warning') }}</span><button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button></div>@endif
                @if(session('info'))<div class="custom-alert alert-info-custom"><i class="fas fa-info-circle"></i><span>{{ session('info') }}</span><button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button></div>@endif
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
