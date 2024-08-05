<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('cmuitaccount')) {
            if ($request->session()->has('isAdmin')) {
                $userFullname = $request->session()->get('cmuitaccount');
                $last_activity = $request->session()->get('last_activity');
                if (now()->diffInMinutes($last_activity) > 120) {
                    $request->session()->forget('cmuitaccount');
                    return redirect('admin/login')->with('message', 'Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
                }
            } else {
                return redirect('admin/login')->with('message', 'Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
            }
        } else {
            return redirect('admin/login')->with('message', 'Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
        }

        return $next($request);
    }
}
