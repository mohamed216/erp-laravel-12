<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\POSController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\ChartsController;
use App\Http\Controllers\NotificationSSEController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/setlang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('setlang');

Route::get('/notifications/stream', [NotificationSSEController::class, 'stream']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::post('/settings', [SettingsController::class, 'update']);
    Route::get('/backup', [BackupController::class, 'index']);
    Route::post('/backup/create', [BackupController::class, 'create']);
    Route::get('/backup/download/{file}', [BackupController::class, 'download']);
    Route::post('/backup/restore/{file}', [BackupController::class, 'restore']);
    Route::post('/backup/delete/{file}', [BackupController::class, 'delete']);
});

Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
    Route::resource('suppliers', SupplierController::class)->only(['index', 'store', 'destroy']);
    Route::resource('expenses', ExpenseController::class)->only(['index', 'store', 'destroy']);
    Route::resource('invoices', InvoiceController::class);
    Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print']);
    Route::resource('bank-accounts', BankAccountController::class)->only(['index', 'store', 'destroy']);
    Route::resource('employees', EmployeeController::class)->only(['index', 'store', 'destroy']);
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::get('/reports/sales', [ReportController::class, 'sales']);
    Route::get('/reports/inventory', [ReportController::class, 'inventory']);
    Route::get('/reports/expenses', [ReportController::class, 'expenses']);
    Route::get('/reports/profit', [ReportController::class, 'profit']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', fn() => redirect('/dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('orders', OrderController::class);
    Route::resource('inventory', InventoryController::class)->except(['show', 'destroy', 'create', 'store']);
    Route::get('/pos', [POSController::class, 'index']);
    Route::post('/pos/create', [POSController::class, 'createOrder']);
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::resource('goals', GoalController::class);
Route::resource('budgets', BudgetController::class)->only(['index', 'store', 'update', 'destroy']);
Route::get('/charts', [ChartsController::class, 'index']);
});
