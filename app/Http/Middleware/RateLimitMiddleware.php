<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    protected $maxAttempts = 60;
    protected $decaySeconds = 60;

    public function handle(Request $request, Closure $next): Response
    {
        $key = 'login:' . $request->ip();
        $attempts = cache($key, 0);
        
        if ($attempts >= $this->maxAttempts) {
            return response()->json(['error' => 'Too many attempts. Please try again later.'], 429);
        }
        
        cache([$key => $attempts + 1], $this->decaySeconds);
        
        return $next($request);
    }
}
