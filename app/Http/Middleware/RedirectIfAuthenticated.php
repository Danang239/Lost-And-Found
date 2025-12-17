<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->email === 'admin1@gmail.com') {
                    return redirect('/admin/homepage');
                }

                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
