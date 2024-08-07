<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class deanApporveController extends Controller
{
    //คณบดี     
    public function __construct()
    {
        $this->middleware('checkusertype:dean');
    }
    public function index()
    {
        return view('admin.dean_dashboard');
    }
}