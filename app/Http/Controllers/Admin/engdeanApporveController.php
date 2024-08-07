<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class engdeanApporveController extends Controller
{
     //รองคณบดี
    public function __construct()
    {
        $this->middleware('checkusertype:deaneng');
    }
    public function index()
    {
        return view('admin.eng_dashboard');
    }
}