<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Allow login/register pages without session
        if (!session()->has('user_id') && !$request->is('login') && !$request->is('register') && !$request->is('login/*')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
