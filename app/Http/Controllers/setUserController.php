<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class setUserController extends Controller
{
    //

    public function setUserbypass(Request $request)
    {
        if (!empty($request->email)) {
            $profile = User::where('email', $request->email)->first();
            if ($profile) {
                $fullname = $profile["firstname_TH"] . ' ' . $profile["lastname_TH"];

                $request->session()->put('cmuitaccount', $profile["email"]);
                $request->session()->put('userfullname', $fullname);
                $request->session()->put('dep_id', $profile["dep_id"]);
                $request->session()->put('isAdmin',$profile["isAdmin"]);
                $request->session()->put('isDean', $profile["isDean"]);
                $request->session()->put('last_activity', Carbon::now());
                $request->session()->put('positionName', $profile["positionName"]);
                $request->session()->put('positionName2', $profile["positionName2"]);                
                $request->session()->put('is_step_secretary', $profile["is_step_secretary"]);
                $request->session()->put('is_step_dean', $profile["is_step_dean"]);
                $request->session()->put('is_step_eng', $profile["is_step_eng"]);
                $request->session()->put('user_type', $profile["user_type"]);

             
                if($profile["user_type"]=="secretary" || $profile["user_type"]=="eng" || $profile["user_type"]=="deaneng" || $profile["user_type"]=="dean"){
                    return redirect()->intended('/admin/stepapporve')->with('success', 'Login Successfull');
                }else {
                    return redirect()->intended('/admin/dashboard')->with('success', 'Login Successfull');
                }
                

            }
        }
    }
}