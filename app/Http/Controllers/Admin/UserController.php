<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized');
        }
        $users = User::when($request->search, fn($q, $s) => $q->where('name', 'like', "%$s%"))->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized');
        }
        return view('admin.users.create');
    }

    public function store(Request $r)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized');
        }
        $data = $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required|in:admin,manager,employee'
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized');
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $r, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized');
        }
        $data = $r->validate(['name' => 'required', 'email' => 'required|email', 'role' => 'required|in:admin,manager,employee']);
        if ($r->password) $data['password'] = Hash::make($r->password);
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Unauthorized');
        }
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Cannot delete yourself');
        }
        $user->delete();
        return back()->with('success', 'User deleted');
    }
}
