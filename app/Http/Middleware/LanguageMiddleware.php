<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', 'ar');
        app()->setLocale($locale);
        
        return $next($request);
    }
}
