<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }
        
        $userRole = $request->user()->role;
        $roles = explode('|', $role);
        
        if (!in_array($userRole, $roles)) {
            return redirect('/dashboard')->with('error', 'Unauthorized');
        }
        
        return $next($request);
    }
}
