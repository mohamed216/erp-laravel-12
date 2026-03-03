<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;
class BankAccountController extends Controller
{
    public function index() { $accounts = BankAccount::all(); return view('admin.bank_accounts.index', compact('accounts')); }
    public function store(Request $r) { BankAccount::create($r->validate(['name' => 'required', 'account_number' => 'required'])); return back()->with('success', 'Account added'); }
    public function destroy(BankAccount $account) { $account->delete(); return back()->with('success', 'Account deleted'); }
}
