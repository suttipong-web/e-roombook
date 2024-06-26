<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (!auth()->user()->is_admin) {
                return redirect()->route('getLogin')->with('error', 'You have to be admin user to access this page');
            }
        } else {
            return redirect()->route('getLogin')->with('error', 'You have to be logged in to access this page');
        }
        return $next($request);
    }
}
