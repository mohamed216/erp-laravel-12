<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: white; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); padding: 40px; max-width: 400px; width: 100%; }
        .form-control { border-radius: 10px; padding: 12px; }
        .btn-primary { border-radius: 10px; padding: 12px; background: #667eea; border: none; }
        .btn-primary:hover { background: #5568d3; }
    </style>
</head>
<body>
    <div class="login-card">
        <h3 class="text-center mb-4">🏢 ERP System</h3>
        <h5 class="text-center mb-4">تسجيل الدخول</h5>
        
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">دخول</button>
        </form>
        
        <div class="text-center mt-3">
            <small>Email: admin@erp.com</small><br>
            <small>Password: password</small>
        </div>
    </div>
</body>
</html>
