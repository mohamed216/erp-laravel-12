<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::orderBy('date', 'DESC')->paginate(10);
        $total = Expense::sum('amount');
        return view('admin.expenses.index', compact('expenses', 'total'));
    }

    public function store(Request $r)
    {
        Expense::create($r->all());
        return back()->with('success', 'Expense added');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return back()->with('success', 'Expense deleted');
    }
}
