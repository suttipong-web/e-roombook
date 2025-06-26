<?php

namespace App\Http\Controllers;

use App\class\HelperService;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class cmuOauthController extends Controller
{
    // POST API CMU OAUTH  REQEUST authorization_code FORM  https://oauth.cmu.ac.th/v1/GetToken.aspx?code
    public function callback(Request $request)
    {
        $roomId = 0;
        $code = $request->code;
        $state = $request->state;

        $temp = explode('_', $state);
        if (!empty($temp[1]))
            $roomId = $temp[1];
        if (!empty($temp[2]))
            $dates = $temp[2];
        $page = $temp[0];
        $cmuKey = DB::table('tbl_apikey')
            ->select('clientID', 'clientSecret', 'redirect_uri')
            ->where('apiweb', '=', 'cmuoauth')
            ->first();
        //ร้องขอ  authorization_code  เพื่อนำไป login เพื่อ ขอข้อมูลพนักงาน   
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
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
        curl_setopt_array(
            $curlStep2,
            array(
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

            if ($users) {
                //if((int)$users["dep_id"] < 14 || (int)$users["dep_id"]==29 || (int)$users["dep_id"]==28) {
                $getDepN = DB::table('department')
                    ->select('dep_name')
                    ->where('dep_id', $users["dep_id"])
                    ->get();
                if (!empty($roomId)) {
                    $roomData = Rooms::find($roomId);
                }

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

                if ((int) $users["dep_id"] < 14 || (int) $users["dep_id"] == 29 || (int) $users["dep_id"] == 28 || (int) $users["dep_id"] == 31) {
                    $request->session()->put('depTypeBooking', 'ENG');
                } else {
                    $request->session()->put('depTypeBooking', 'MAJOR');
                }

                $request->session()->put('cmuitaccount', $email);
                $request->session()->put('userfullname', $fullname);
                $request->session()->put('dep_id', $users["dep_id"]);
                $request->session()->put('isAdmin', $users["isAdmin"]);
                $request->session()->put('isDean', $users["isDean"]);
                $request->session()->put('last_activity', Carbon::now());
                $request->session()->put('positionName', $users["positionName"]);
                $request->session()->put('positionName2', $users["positionName2"]);
                $request->session()->put('dep_name', $getDepN[0]->dep_name);
                //$request->session()->put('user_type',$users["user_type"]);    

                //check Admin  

                if (!empty($users["user_type"])) {
                    $request->session()->put('is_step_secretary', $users["is_step_secretary"]);
                    $request->session()->put('is_step_dean', $users["is_step_dean"]);
                    $request->session()->put('is_step_eng', $users["is_step_eng"]);
                    $request->session()->put('user_type', $users["user_type"]);
                }


                if ($page == "bookingindex") {
                    return redirect()->intended('/booking')->with('success', 'Login Successfull');
                } elseif ($page == "booking") {
                    return redirect()->intended('/booking/form/' . $roomId . '/eng/' . $roomData->roomFullName . '/' . $dates)->with('success', 'Login Successfull');
                } elseif ($users["user_type"] == "admin" && $page == "admin") {
                    return redirect()->intended('/admin/dashboard')->with('success', 'Login Successfull');
                } elseif (($users["user_type"] == "secretary" || $users["user_type"] == "eng" || $users["user_type"] == "deaneng" || $users["user_type"] == "dean") && $page == "admin") {
                    return redirect()->intended('/admin/stepapporve')->with('success', 'Login Successfull');
                } elseif ($users["user_type"] == "major" && $page == "admin") {
                    return redirect()->intended('/major')->with('success', 'Login Successfull');
                } else {
                    return redirect()->intended('/booking')->with('success', 'Login Successfull');
                }
                //}
            }

            //return back()->withErrors(['email' => 'ข้อมูลไม่ถูกต้อง']);
            return view('errorLogin')->with([
                'displayError' => 'cmu Acount not found'
            ]);
        }
        return view('errorLogin')->with([
            'displayError' => 'cmu Acount not found '
        ]);
    }

    public function callbackms(Request $request)
    {
        $class = new HelperService();
        $roomId = 0;


        if (!empty($request->state)) {
            $state = $request->state;
            $temp = explode('_', $state);
            if (!empty($temp[1]))
                $roomId = $temp[1];
            if (!empty($temp[2]))
                $dates = $temp[2];
            $page = $temp[0];
        }
        if (!empty($request->code)) {
            $code = $request->code;
            $MSconfig = array(
                "AUTH_URL" => "https://login.microsoftonline.com/cf81f1df-de59-4c29-91da-a2dfd04aa751/oauth2/v2.0/authorize",
                "TOKEN_URL" => "https://login.microsoftonline.com/cf81f1df-de59-4c29-91da-a2dfd04aa751/oauth2/v2.0/token",
                "CALLBACK_URL" => "https://e-roombook.eng.cmu.ac.th/callbackms",
                "CLIENT_ID" => env('CLIENT_ID'),
                "CLIENT_SECRET" => env('CLIENT_SECRET'),
                "SCOPE" => "api://cmu/Mis.Account.Read.Me.Basicinfo",
                "BASICINFO_URL" => "api://cmu/Mis.Account.Read.Me.Basicinfo",
                "LOGOUT_URL" => 'https://e-roombook.eng.cmu.ac.th'
            );

            // header("Location:access_token.php?do=getToken&code=".$_GET["code"]."&cate=".$_GET["state"]);
            // Load environment variables
            $data = [
                'grant_type' => 'authorization_code',
                'client_id' => $MSconfig['CLIENT_ID'],
                'client_secret' => $MSconfig['CLIENT_SECRET'],
                'redirect_uri' => $MSconfig['CALLBACK_URL'],
                'scope' => $MSconfig['SCOPE'],
                'code' => $code
            ];

            //get acess token
            $options = [
                CURLOPT_URL => $MSconfig['TOKEN_URL'],
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/x-www-form-urlencoded'
                ],
            ];
            $ch = curl_init();
            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);
            curl_close($ch);
            if (curl_errno($ch)) {
                return view('admin.auth.error')->with([
                    'displayError' => true
                ]);
            } else {
                if (empty($callback_dataAuthCode['access_token'])) {
                    return view('admin.auth.error')->with([
                        'displayError' => true
                    ]);
                }
                $json = json_decode($response, true);
                $access_token = $json["access_token"];
                $curl2 = curl_init();
                curl_setopt_array($curl2, [
                    CURLOPT_URL => 'https://api.cmu.ac.th/mis/cmuaccount/prod/v3/me/basicinfo',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer " . $access_token,
                    ],
                ]);
                $basic_info = curl_exec($curl2);
                $err = curl_error($curl2);
                curl_close($curl2);

                $cmuitaccount = json_decode($basic_info, true);

                if (!empty($cmuitaccount["cmuitaccount"])) {
                    // ตรวจสอบสิทธิของผู้ใช้ ว่าสามาถเข้า Admin ได้ไหม หรือ ประเภท             
                    $email = $cmuitaccount["cmuitaccount"];
                    $users = User::where('email', $email)->first();

                    if ($users) {
                        //if((int)$users["dep_id"] < 14 || (int)$users["dep_id"]==29 || (int)$users["dep_id"]==28) {
                        $getDepN = DB::table('department')
                            ->select('dep_name')
                            ->where('dep_id', $users["dep_id"])
                            ->get();
                        if (!empty($roomId)) {
                            $roomData = Rooms::find($roomId);
                        }

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

                        if ((int) $users["dep_id"] < 14 || (int) $users["dep_id"] == 29 || (int) $users["dep_id"] == 28 || (int) $users["dep_id"] == 31) {
                            $request->session()->put('depTypeBooking', 'ENG');
                        } else {
                            $request->session()->put('depTypeBooking', 'MAJOR');
                        }

                        $request->session()->put('cmuitaccount', $email);
                        $request->session()->put('userfullname', $fullname);
                        $request->session()->put('dep_id', $users["dep_id"]);
                        $request->session()->put('isAdmin', $users["isAdmin"]);
                        $request->session()->put('isDean', $users["isDean"]);
                        $request->session()->put('last_activity', Carbon::now());
                        $request->session()->put('positionName', $users["positionName"]);
                        $request->session()->put('positionName2', $users["positionName2"]);
                        $request->session()->put('dep_name', $getDepN[0]->dep_name);
                        //$request->session()->put('user_type',$users["user_type"]);    

                        //check Admin  

                        if (!empty($users["user_type"])) {
                            $request->session()->put('is_step_secretary', $users["is_step_secretary"]);
                            $request->session()->put('is_step_dean', $users["is_step_dean"]);
                            $request->session()->put('is_step_eng', $users["is_step_eng"]);
                            $request->session()->put('user_type', $users["user_type"]);
                        }


                        if ($page == "bookingindex") {
                            return redirect()->intended('/booking')->with('success', 'Login Successfull');
                        } elseif ($page == "booking") {
                            return redirect()->intended('/booking/form/' . $roomId . '/eng/' . $roomData->roomFullName . '/' . $dates)->with('success', 'Login Successfull');
                        } elseif ($users["user_type"] == "admin" && $page == "admin") {
                            return redirect()->intended('/admin/dashboard')->with('success', 'Login Successfull');
                        } elseif (($users["user_type"] == "secretary" || $users["user_type"] == "eng" || $users["user_type"] == "deaneng" || $users["user_type"] == "dean") && $page == "admin") {
                            return redirect()->intended('/admin/stepapporve')->with('success', 'Login Successfull');
                        } elseif ($users["user_type"] == "major" && $page == "admin") {
                            return redirect()->intended('/major')->with('success', 'Login Successfull');
                        } else {
                            return redirect()->intended('/booking')->with('success', 'Login Successfull');
                        }
                        //}
                    }

                    //return back()->withErrors(['email' => 'ข้อมูลไม่ถูกต้อง']);
                    return view('errorLogin')->with([
                        'displayError' => 'cmu Acount not found'
                    ]);
                }
                return view('errorLogin')->with([
                    'displayError' => 'cmu Acount not found '
                ]);

            }
        }
    }
}