<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User; use App\Models\Customer; use App\Models\Product;
use App\Models\Order; use App\Models\Expense; use App\Models\Employee;
use App\Models\Supplier; use App\Models\BankAccount; use App\Models\Inventory;

class DashboardController extends Controller
{
    public function index()
    {
        // Orders stats
        $inventoryCost = 0; $inventoryValue = 0;
        foreach (Inventory::with('product')->get() as $inv) {
            $inventoryCost += ($inv->product?->cost_price ?? 0) * $inv->stock_quantity;
            $inventoryValue += ($inv->product?->price ?? 0) * $inv->stock_quantity;
        }

        $revenue = Order::where('status', 'completed')->sum('total_amount');
        
        $profit = 0;
        foreach (Order::where('status', 'completed')->with('items')->get() as $order) {
            foreach ($order->items as $item) {
                $cost = $item->product?->cost_price ?? 0;
                $profit += ($item->price - $cost) * $item->quantity;
            }
        }

        $expenses = Expense::sum('amount');
        $employees = Employee::count();
        $suppliers = Supplier::count();
        $bankBalance = BankAccount::sum('balance');

        $stats = [
            'users' => User::count(),
            'customers' => Customer::count(),
            'products' => Product::count(),
            'orders' => Order::count(),
            'revenue' => $revenue,
            'profit' => $profit,
            'expenses' => $expenses,
            'net_profit' => $profit - $expenses,
            'inventory_cost' => $inventoryCost,
            'inventory_value' => $inventoryValue,
            'employees' => $employees,
            'suppliers' => $suppliers,
            'bank_balance' => $bankBalance,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
