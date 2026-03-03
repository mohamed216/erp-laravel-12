<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Auth2FAController extends Controller
{
    public function showVerify() {
        if (!session('2fa_pending')) return redirect('/login');
        return view('auth.2fa');
    }

    public function verify(Request $r) {
        if (!session('2fa_pending')) return redirect('/login');
        
        $user = User::where('email', session('2fa_email'))->first();
        
        if ($user && Hash::check($r->code, $user->two_factor_code)) {
            if ($user->two_factor_expires < now()) {
                return back()->with('error', 'Code expired');
            }
            Auth::login($user);
            session()->forget('2fa_pending');
            session()->forget('2fa_email');
            return redirect('/dashboard');
        }
        
        return back()->with('error', 'Invalid code');
    }

    public function setup(Request $r) {
        $user = Auth::user();
        $code = rand(100000, 999999);
        
        $user->update([
            'two_factor_code' => Hash::make($code),
            'two_factor_expires' => now()->addMinutes(10)
        ]);
        
        // In production, send SMS/Email here
        // For demo, show code
        return back()->with('success', 'Your 2FA code: ' . $code);
    }

    public function disable() {
        $user = Auth::user();
        $user->update(['two_factor_code' => null, 'two_factor_expires' => null]);
        return back()->with('success', '2FA disabled');
    }
}
