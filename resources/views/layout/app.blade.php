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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: #f4f6f9; }
        .sidebar { background: #fff; min-height: 100vh; box-shadow: 2px 0 10px rgba(0,0,0,0.05); }
        .sidebar a { color: #333; padding: 10px 15px; display: block; text-decoration: none; border-radius: 6px; margin: 2px 5px; font-size: 14px; }
        .sidebar a:hover, .sidebar a.active { background: #4f46e5; color: #fff; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logout-btn { color: #dc3545; padding: 10px 15px; display: block; text-decoration: none; border-radius: 6px; margin: 2px 5px; border: none; background: none; width: 100%; text-align: start; cursor: pointer; font-size: 14px; }
        .logout-btn:hover { background: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
            <?php $role = auth()->user()->role; ?>
            <div class="col-md-2 sidebar p-0">
                <div class="p-2 border-bottom d-flex justify-content-between align-items-center">
                    <h6 class="m-0">🏢 ERP</h6>
                    <a href="/setlang/en" class="btn btn-sm btn-outline-secondary">EN</a>
                </div>
                <nav>
                    <a href="/dashboard">📊 {{ session('locale') == 'en' ? 'Dashboard' : 'لوحة التحكم' }}</a>
                    
                    @if($role == 'admin')
                    <a href="/users">👥 {{ session('locale') == 'en' ? 'Users' : 'المستخدمين' }}</a>
                    @endif
                    
                    @if(in_array($role, ['admin', 'manager']))
                    <a href="/customers">👤 {{ session('locale') == 'en' ? 'Customers' : 'العملاء' }}</a>
                    <a href="/products">📦 {{ session('locale') == 'en' ? 'Products' : 'المنتجات' }}</a>
                    <a href="/categories">🏷️ {{ session('locale') == 'en' ? 'Categories' : 'التصنيفات' }}</a>
                    <a href="/suppliers">🚚 {{ session('locale') == 'en' ? 'Suppliers' : 'الموردين' }}</a>
                    <a href="/invoices">📄 {{ session('locale') == 'en' ? 'Invoices' : 'الفواتير' }}</a>
                    <a href="/expenses">💸 {{ session('locale') == 'en' ? 'Expenses' : 'المصروفات' }}</a>
                    @endif
                    
                    <a href="/orders">🛒 {{ session('locale') == 'en' ? 'Orders' : 'الطلبات' }}</a>
                    <a href="/inventory">📈 {{ session('locale') == 'en' ? 'Inventory' : 'المخزون' }}</a>
                    
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="logout-btn">🚪 {{ session('locale') == 'en' ? 'Logout' : 'تسجيل خروج' }}</button>
                    </form>
                </nav>
            </div>
            @endauth
            <div class="{{ auth()->check() ? 'col-md-10' : 'col-md-12' }} p-3">
                @auth
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>@yield('page_title', session('locale') == 'en' ? 'Dashboard' : 'لوحة التحكم')</h5>
                    <div>
                        <span class="badge bg-{{ $role == 'admin' ? 'danger' : ($role == 'manager' ? 'info' : 'secondary') }}">
                            {{ $role }}
                        </span>
                        <small class="text-muted ms-2">👤 {{ auth()->user()->name }}</small>
                        <a href="/setlang/ar" class="btn btn-sm btn-outline-primary ms-2">عربي</a>
                    </div>
                </div>
                @endauth
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
