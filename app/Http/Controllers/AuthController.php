<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    protected $maxLoginAttempts = 5;
    protected $lockoutTime = 300; // 5 minutes

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Check rate limiting
        $key = 'login:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, $this->maxLoginAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->with('error', "Too many login attempts. Please try again in " . ceil($seconds/60) . " minutes.");
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        
        // Add rate limiting attempt
        RateLimiter::hit($key, $this->lockoutTime);

        if (Auth::attempt($credentials)) {
            // Clear rate limit on successful login
            RateLimiter::clear($key);
            
            $request->session()->regenerate();
            
            // Log the login
            activity()
                ->causedBy(Auth::user())
                ->log('User logged in');
            
            return redirect()->intended('/dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        // Log the logout
        if (Auth::check()) {
            activity()
                ->causedBy(Auth::user())
                ->log('User logged out');
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
