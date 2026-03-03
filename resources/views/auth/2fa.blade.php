<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:linear-gradient(135deg,#667eea,#764ba2);min-height:100vh;display:flex;align-items:center;justify-content:center}.card{border-radius:20px;padding:40px;max-width:400px;width:100%}</style>
</head>
<body>
    <div class="card bg-white">
        <h3 class="text-center mb-4">🔐 Two-Factor Auth</h3>
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
        <form method="POST" action="/2fa/verify">@csrf
            <input type="text" name="code" class="form-control form-control-lg text-center mb-3" placeholder="Enter 6-digit code" maxlength="6" required>
            <button class="btn btn-primary w-100 btn-lg">Verify</button>
        </form>
    </div>
</body>
</html>
