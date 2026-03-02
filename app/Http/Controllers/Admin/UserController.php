<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::when($request->search, fn($q, $s) => $q->where('name', 'like', "%$s%"))->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $r, User $user)
    {
        $data = $r->validate(['name' => 'required', 'email' => 'required|email', 'role' => 'required']);
        if ($r->password) $data['password'] = Hash::make($r->password);
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }
}
