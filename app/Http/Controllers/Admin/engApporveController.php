<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class engApporveController extends Controller
{
    //
    //หัวหน้างานบริหาร
    public function __construct()
    {
        $this->middleware('checkusertype:eng');
    }
    public function index()
    {
        return view('admin.eng_dashboard');
    }
}