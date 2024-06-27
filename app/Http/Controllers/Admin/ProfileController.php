<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function dashboard(Request $request)
    {

        $user = "";
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
        }


        return view('admin.dashboard')->with([
            'title' => 'Dashboard',
            'sessionUser' => $user
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out');
    }
}
