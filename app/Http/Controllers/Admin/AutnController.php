<?php

namespace App\Http\Controllers\Admin;

use App\class\HelperService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class AutnController extends Controller
{
    //
    public function getlogin()
    {
        $getService = new HelperService();
        // get CMU APIKEY clientID,clientSecret
        $cmuKey = DB::table('tbl_apikey')
            ->select('clientID', 'clientSecret', 'redirect_uri')
            ->where('apiweb', '=', 'cmuoauth')
            ->first();
        $reurl =  "";
        $state =  "admin_-_-";
        $CMUOauth = $getService->geturlCMUOauth($state);
    
        //$signwithCmu = 'https://oauth.cmu.ac.th/v1/Authorize.aspx?response_type=code&client_id=' . $cmuKey->clientID . '&redirect_uri=' . $cmuKey->redirect_uri . '&scope=cmuitaccount.basicinfo&state=admin-0';
       
        return view('admin.auth.login')->with(
            [
                'urlCMUOauth' =>  $CMUOauth ,
            ]
        );
    }

    // POST API CMU OAUTH  REQEUST authorization_code FORM  https://oauth.cmu.ac.th/v1/GetToken.aspx?code
    public function authorization_code(Request $request)
    {
        $code = request()->query('code');
        $cmuKey = DB::table('tbl_apikey')
            ->select('clientID', 'clientSecret', 'redirect_uri')
            ->where('apiweb', '=', 'cmuoauth')
            ->first();

        //ร้องขอ  authorization_code  เพื่อนำไป login เพื่อ ขอข้อมูลพนักงาน   
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://oauth.cmu.ac.th/v1/GetToken.aspx?code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'code=' . $code . '&redirect_uri=' . $cmuKey->redirect_uri . '&client_id=' . $cmuKey->clientID . '&client_secret=' . $cmuKey->clientSecret . '&grant_type=authorization_code',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        )
        );

        $responseAuthCode = curl_exec($curl);
        curl_close($curl);
        $callback_dataAuthCode = json_decode($responseAuthCode, true);

        if (empty($callback_dataAuthCode['access_token'])) {
            return view('admin.auth.error')->with([
                'displayError' => true
            ]);
        }
        $access_token = $callback_dataAuthCode['access_token'];

        // เมื่อได้  access_token ก็  CURLOPT_CUSTOMREQUEST   ไปขอ basicinfo ด้วย access_token ที่ได้ 
        // return   basicinfo 
        $curlStep2 = curl_init();
        curl_setopt_array($curlStep2, array(
            CURLOPT_URL => "https://misapi.cmu.ac.th/cmuitaccount/v1/api/cmuitaccount/basicinfo?access_token=" . $access_token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        )
        );
        $responseInfo = curl_exec($curlStep2);
        // รับ response และ แปลงข้อมูลเป็น json
        $cmuitaccount = json_decode($responseInfo, true);
        curl_close($curlStep2);
        if (!empty($cmuitaccount["cmuitaccount"])) {

            // ตรวจสอบสิทธิของผู้ใช้ ว่าสามาถเข้า Admin ได้ไหม หรือ ประเภท             
            $email = $cmuitaccount["cmuitaccount"];
            $users = User::where('email', $email)->first();
            $getDepN = DB::table('department')
             ->select('dep_name')
             ->where('dep_id',$users["dep_id"])           
             ->get();



            if (!empty($users["user_type"])) {
                // UPDATE  ข้อมูลในตาราง Table  user 
                $setData = [
                    'cmuitaccount_name' => $cmuitaccount["cmuitaccount_name"],
                    'prename_TH' => $cmuitaccount["prename_TH"],
                    'firstname_TH' => $cmuitaccount["firstname_TH"],
                    'lastname_TH' => $cmuitaccount["lastname_TH"],
                    'itaccounttype_id' => $cmuitaccount["itaccounttype_id"],
                    'itaccounttype_TH' => $cmuitaccount["itaccounttype_TH"],
                    'updated_at' => Carbon::now(),
                    'last_activity' => Carbon::now()
                ];
                $users->update($setData);
                // สร้าง session พร้อมกำหนดเวลาหมดอายุ (2 ชั่วโมง)
                //$request->session()->put('user', $users, 120);
                $fullname = $cmuitaccount["firstname_TH"] . ' ' . $cmuitaccount["lastname_TH"];

                $request->session()->put('cmuitaccount', $email);
                $request->session()->put('userfullname', $fullname);
                $request->session()->put('dep_id', $users["dep_id"]);
                 $request->session()->put('dep_name',$getDepN[0]->dep_name);
                $request->session()->put('isAdmin', $users["isAdmin"]);
                $request->session()->put('isDean', $users["isDean"]);
                $request->session()->put('last_activity', Carbon::now());
                $request->session()->put('positionName', $users["positionName"]);
                $request->session()->put('positionName2', $users["positionName2"]);
                $request->session()->put('is_step_secretary', $users["is_step_secretary"]);
                $request->session()->put('is_step_dean', $users["is_step_dean"]);
                $request->session()->put('is_step_eng', $users["is_step_eng"]); 
                $request->session()->put('user_type', $users["user_type"]);
                //11
                if($users["user_type"]=="secretary" || $users["user_type"]=="eng" || $users["user_type"]=="deaneng" || $users["user_type"]=="dean"){
                    return redirect()->intended('/admin/stepapporve')->with('success', 'Login Successfull');
                }else {
                    return redirect()->intended('/admin/dashboard')->with('success', 'Login Successfull');
                }
               
            }
            //return back()->withErrors(['email' => 'ข้อมูลไม่ถูกต้อง']);
            return view('admin.auth.error')->with([
                'displayError' => true
            ]);
        }
        return view('admin.auth.error')->with([
            'displayError' => ' '
        ]);
    }


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $passwords = md5($request->password);
        $validated = auth()->attempt([
            'email' => $request->email,
            'password' => $passwords,
            'isAdmin' => 1
        ], $request->password);


        if ($validated) {
            return redirect()->route('dashboard')->with('success', 'Login Successfull');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }


}