<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutnController extends Controller
{
    //
    public function getlogin()
    {
        return view('admin.auth.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        ///$validated = auth()->attempt([
        //    'email' => $request->email,
        //   'password' => $request->password,
        //   'isAdmin' => 1
        //   ], $request->password);
        $validated  =(){
            
        }

        if ($validated) {
            return redirect()->route('dashboard')->with('success', 'Login Successfull');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
}
