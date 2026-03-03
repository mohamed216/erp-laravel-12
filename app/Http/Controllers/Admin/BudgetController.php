<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Expense;
use Illuminate\Http\Request;
class BudgetController extends Controller
{
    public function index() {
        $budgets = Budget::orderBy('year', 'DESC')->orderBy('month', 'DESC')->get();
        return view('admin.budgets.index', compact('budgets'));
    }
    public function store(Request $r) {
        Budget::create($r->all());
        return back()->with('success', 'Budget added');
    }
    public function update(Request $r, Budget $budget) {
        $budget->update($r->all());
        return back()->with('success', 'Budget updated');
    }
    public function destroy(Budget $budget) {
        $budget->delete();
        return back()->with('success', 'Budget deleted');
    }
}
