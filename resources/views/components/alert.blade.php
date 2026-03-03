@if(session('success') || session('error') || session('warning') || session('info'))
<style>
    .custom-alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideIn 0.3s ease;
    }
    .custom-alert i { font-size: 20px; }
    .alert-success-custom { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .alert-error-custom { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
    .alert-warning-custom { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .alert-info-custom { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
    @keyframes slideIn {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .btn-close { filter: invert(1); }
</style>

@if(session('success'))
<div class="custom-alert alert-success-custom">
    <i class="fas fa-check-circle"></i>
    <span>{{ session('success') }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="custom-alert alert-error-custom">
    <i class="fas fa-exclamation-circle"></i>
    <span>{{ session('error') }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('warning'))
<div class="custom-alert alert-warning-custom">
    <i class="fas fa-exclamation-triangle"></i>
    <span>{{ session('warning') }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('info'))
<div class="custom-alert alert-info-custom">
    <i class="fas fa-info-circle"></i>
    <span>{{ session('info') }}</span>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
</div>
@endif
@endif
