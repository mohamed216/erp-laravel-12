<!DOCTYPE html>
<html lang="{{ session('locale', 'ar') }}" dir="{{ session('locale', 'ar') == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ERP System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @if(session('locale', 'ar') == 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css.css">
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background: #f4f6f9; margin: 0; }
        .lang-bar { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); padding: 8px 20px; display: flex; justify-content: space-between; align-items: center; }
        .lang-bar a { color: white; text-decoration: none; padding: 5px 15px; border-radius: 20px; margin: 0 3px; font-size: 14px; transition: 0.3s; }
        .lang-bar a:hover { background: rgba(255,255,255,0.2); }
        .lang-bar a.active { background: #ffd700; color: #333; font-weight: bold; }
        .sidebar { background: #fff; min-height: calc(100vh - 45px); box-shadow: 2px 0 10px rgba(0,0,0,0.05); }
        .sidebar a { color: #333; padding: 12px 20px; display: block; text-decoration: none; border-radius: 8px; margin: 3px 8px; font-size: 14px; }
        .sidebar a:hover, .sidebar a.active { background: #4f46e5; color: #fff; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logout-btn { color: #dc3545; padding: 12px 20px; display: block; text-decoration: none; border-radius: 8px; margin: 3px 8px; border: none; background: none; width: 100%; text-align: start; cursor: pointer; font-size: 14px; }
        .logout-btn:hover { background: #dc3545; color: #fff; }
    </style>
</head>
<body>
    <div class="lang-bar">
        <span style="color:white;font-weight:bold">🏢 ERP System</span>
        <div>
            <a href="/setlang/en" class="{{ session('locale') != 'ar' ? 'active' : '' }}">🇺🇸 English</a>
            <a href="/setlang/ar" class="{{ session('locale') == 'ar' ? 'active' : '' }}">🇸🇦 العربية</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @auth
            <?php $role = auth()->user()->role; ?>
            <div class="col-md-2 sidebar p-0">
                <nav style="padding-top: 10px;">
                    <a href="/dashboard">📊 {{ session('locale') == 'en' ? 'Dashboard' : 'لوحة التحكم' }}</a>
                    <a href="/pos">💰 {{ session('locale') == 'en' ? 'POS' : 'نقطة بيع' }}</a>
                    
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
                    
                    <div style="margin:10px 15px;border-top:1px solid #eee"></div>
                    <a href="/reports/sales">📈 {{ session('locale') == 'en' ? 'Sales Report' : 'تقرير المبيعات' }}</a>
                    <a href="/reports/inventory">📦 {{ session('locale') == 'en' ? 'Inventory Report' : 'تقرير المخزون' }}</a>
                    <a href="/reports/expenses">💸 {{ session('locale') == 'en' ? 'Expenses Report' : 'تقرير المصروفات' }}</a>
                    <a href="/reports/profit">💵 {{ session('locale') == 'en' ? 'Profit Report' : 'تقرير الأرباح' }}</a>
                    
                    <a href="/settings">⚙️ {{ session('locale') == 'en' ? 'Settings' : 'الإعدادات' }}</a>
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
            <div class="{{ auth()->check() ? 'col-md-10' : 'col-md-12' }} p-4">
                @auth
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>@yield('page_title', session('locale') == 'en' ? 'Dashboard' : 'لوحة التحكم')</h4>
                    <div>
                        <span class="badge bg-{{ $role == 'admin' ? 'danger' : ($role == 'manager' ? 'info' : 'secondary') }}">
                            {{ $role }}
                        </span>
                        <small class="text-muted ms-2">👤 {{ auth()->user()->name }}</small>
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
