<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class secretaryController extends Controller
{
    //เลขาคณะ
    public function __construct()
    {
        $this->middleware('checkusertype:secretary');
    }
    public function index()
    {
        return view('admin.secretary_dashboard');
    }
}