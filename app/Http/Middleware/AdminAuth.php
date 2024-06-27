<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
            if (now()->diffInMinutes($user['last_activity']) > 120) {
                $request->session()->forget('user');
                return redirect('login')->with('message', 'Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
            }
            $request->session()->put('user.last_activity', now());
        }

        return $next($request);
    }
}
