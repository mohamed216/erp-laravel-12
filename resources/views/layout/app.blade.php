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
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --dark: #2b2d42;
            --light: #f8f9fa;
        }
        body { 
            background: #f0f2f5; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 12px 20px;
        }
        .navbar-custom .navbar-brand { color: white; font-weight: bold; }
        .navbar-custom .nav-link { color: rgba(255,255,255,0.9); }
        .navbar-custom .nav-link:hover { color: white; }
        .sidebar-custom {
            background: white;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 0;
        }
        .sidebar-custom .menu-item {
            padding: 12px 20px;
            color: var(--dark);
            text-decoration: none;
            display: block;
            border-radius: 0;
            transition: 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar-custom .menu-item:hover, 
        .sidebar-custom .menu-item.active {
            background: #f8f9fa;
            border-left-color: var(--primary);
            color: var(--primary);
        }
        .sidebar-custom .menu-item i { width: 25px; }
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: 0.3s;
        }
        .card-custom:hover { transform: translateY(-3px); box-shadow: 0 5px 20px rgba(0,0,0,0.12); }
        .stat-card { 
            background: white; 
            border-radius: 10px; 
            padding: 20px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .btn-primary-custom {
            background: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .btn-primary-custom:hover { background: var(--secondary); }
        .user-badge {
            background: rgba(255,255,255,0.2);
            padding: 5px 12px;
            border-radius: 20px;
            color: white;
        }
    </style>
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-building"></i> ERP System
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="/setlang/en" class="user-badge text-decoration-none {{ session('locale') != 'ar' ? 'bg-warning' : '' }}">
                    <i class="fas fa-flag-usa"></i> EN
                </a>
                <a href="/setlang/ar" class="user-badge text-decoration-none {{ session('locale') == 'ar' ? 'bg-warning' : '' }}">
                    <i class="fas fa-flag"></i> العربية
                </a>
                <span class="user-badge">
                    <i class="fas fa-user"></i> {{ auth()->user()->name }}
                </span>
                <form method="POST" action="/logout" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
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
                    <a href="/dashboard" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> {{ session('locale') == 'en' ? 'Dashboard' : 'الرئيسية' }}
                    </a>
                    <a href="/notifications" class="menu-item {{ request()->is('notifications*') ? 'active' : '' }}">
                        <i class="fas fa-bell"></i> {{ session('locale') == 'en' ? 'Alerts' : 'التنبيهات' }}
                    </a>
                    <a href="/pos" class="menu-item {{ request()->is('pos*') ? 'active' : '' }}">
                        <i class="fas fa-cash-register"></i> {{ session('locale') == 'en' ? 'POS' : 'نقطة البيع' }}
                    </a>
                    <a href="/backup" class="menu-item {{ request()->is('backup*') ? 'active' : '' }}">
                        <i class="fas fa-database"></i> {{ session('locale') == 'en' ? 'Backup' : 'النسخ الاحتياطي' }}
                    </a>
                    
                    @if($role == 'admin')
                    <div class="mt-3 px-3 text-muted small">{{ session('locale') == 'en' ? 'ADMIN' : 'إدارة' }}</div>
                    <a href="/users" class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> {{ session('locale') == 'en' ? 'Users' : 'المستخدمين' }}
                    </a>
                    <a href="/settings" class="menu-item {{ request()->is('settings*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i> {{ session('locale') == 'en' ? 'Settings' : 'الإعدادات' }}
                    </a>
                    @endif
                    
                    @if(in_array($role, ['admin', 'manager']))
                    <div class="mt-3 px-3 text-muted small">{{ session('locale') == 'en' ? 'MANAGEMENT' : 'إدارة' }}</div>
                    <a href="/customers" class="menu-item {{ request()->is('customers*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i> {{ session('locale') == 'en' ? 'Customers' : 'العملاء' }}
                    </a>
                    <a href="/products" class="menu-item {{ request()->is('products*') ? 'active' : '' }}">
                        <i class="fas fa-box"></i> {{ session('locale') == 'en' ? 'Products' : 'المنتجات' }}
                    </a>
                    <a href="/categories" class="menu-item {{ request()->is('categories*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i> {{ session('locale') == 'en' ? 'Categories' : 'التصنيفات' }}
                    </a>
                    <a href="/suppliers" class="menu-item {{ request()->is('suppliers*') ? 'active' : '' }}">
                        <i class="fas fa-truck"></i> {{ session('locale') == 'en' ? 'Suppliers' : 'الموردين' }}
                    </a>
                    <a href="/invoices" class="menu-item {{ request()->is('invoices*') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice"></i> {{ session('locale') == 'en' ? 'Invoices' : 'الفواتير' }}
                    </a>
                    <a href="/expenses" class="menu-item {{ request()->is('expenses*') ? 'active' : '' }}">
                        <i class="fas fa-money-bill"></i> {{ session('locale') == 'en' ? 'Expenses' : 'المصروفات' }}
                    </a>
                    
                    <div class="mt-3 px-3 text-muted small">{{ session('locale') == 'en' ? 'REPORTS' : 'التقارير' }}</div>
                    <a href="/reports/sales" class="menu-item {{ request()->is('reports*') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> {{ session('locale') == 'en' ? 'Reports' : 'التقارير' }}
                    </a>
                    @endif
                    
                    <div class="mt-3 px-3 text-muted small">{{ session('locale') == 'en' ? 'OPERATIONS' : 'العمليات' }}</div>
                    <a href="/orders" class="menu-item {{ request()->is('orders*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> {{ session('locale') == 'en' ? 'Orders' : 'الطلبات' }}
                    </a>
                    <a href="/inventory" class="menu-item {{ request()->is('inventory*') ? 'active' : '' }}">
                        <i class="fas fa-warehouse"></i> {{ session('locale') == 'en' ? 'Inventory' : 'المخزون' }}
                    </a>
                </nav>
            </div>
            @endauth
            
            <div class="{{ auth()->check() ? 'col-md-10' : 'col-md-12' }} p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
