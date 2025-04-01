<?php

namespace App\class;

use App\Models\adminGroupCourse;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Session;
use Illuminate\Support\Facades\DB;

class HelperService
{

    public static function convertDateThaiWithTime($arg, $addtime, $short)
    {
        if (!empty($arg)) {
            //2024-06-25 07:01:07
            $tempDateTime = explode(" ", $arg);
            $tempDate = explode("-", $tempDateTime[0]);
            $istime = " " . substr($arg, 10, 6);

            if ($short) {
                $thai_months = [1 => 'ม.ค.', 2 => 'ก.พ.', 3 => 'มี.ค.', 4 => 'เม.ย.', 5 => 'พ.ค.', 6 => 'มิ.ย.', 7 => 'ก.ค.', 8 => 'ส.ค.', 9 => 'ก.ย.', 10 => 'ต.ค.', 11 => 'พ.ย.', 12 => 'ธ.ค.',];
            } else {
                $thai_months = [1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม',];
            }

            $dates = $tempDate[2];
            $month = $thai_months[(int) $tempDate[1]];
            $year = $tempDate[0] + 543;
            $setdate = $dates . " " . $month . " " . $year;

            if ($addtime) {
                $setdate = $setdate . " " . $istime;
            }

            return $setdate;
        }
    }

    public function get_TimenowConvert($dt)
    {

        $timenow = explode(":", $dt);
        if ((int) $timenow[1] < 10) {
            $is_time = $timenow[0] . "0" . (int) $timenow[1];
        } else {
            $is_time = $timenow[0] . $timenow[1];
        }
        return (int) $is_time;
    }

    public static function convertDateThaiNoTime($arg, $short)
    {
        //2024-06-25 07:01:07
        $tempinput = explode("-", $arg);


        if ($short) {
            $thai_months = [1 => 'ม.ค.', 2 => 'ก.พ.', 3 => 'มี.ค.', 4 => 'เม.ย.', 5 => 'พ.ค.', 6 => 'มิ.ย.', 7 => 'ก.ค.', 8 => 'ส.ค.', 9 => 'ก.ย.', 10 => 'ต.ค.', 11 => 'พ.ย.', 12 => 'ธ.ค.',];
        } else {
            $thai_months = [1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม',];
        }

        $dates = $tempinput[2];
        $month = $thai_months[(int) $tempinput[1]];
        $year = $tempinput[0] + 543;

        $setdate = $dates . " " . $month . " " . $year;
        return $setdate;
    }


    public static function convertDateThai($arg, $addtime, $short)
    {
        //2024-06-25 07:01:07
        $tempinput = explode(" ", $arg);
        $isdate = $tempinput[0];
        $istime = " " . substr($arg, 10, 6);
        if ($short) {
            $thai_months = [1 => 'ม.ค.', 2 => 'ก.พ.', 3 => 'มี.ค.', 4 => 'เม.ย.', 5 => 'พ.ค.', 6 => 'มิ.ย.', 7 => 'ก.ค.', 8 => 'ส.ค.', 9 => 'ก.ย.', 10 => 'ต.ค.', 11 => 'พ.ย.', 12 => 'ธ.ค.',];
        } else {
            $thai_months = [1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฎาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม',];
        }

        $date_ = DateTime::createFromFormat('d/m/Y', $arg);
        $date = Carbon::parse($date_);
        $month = $thai_months[$date->month];
        $year = $date->year + 543;
        if ($addtime) {
            $setdate = $date->format("j $month $year $istime");
        } else {
            $setdate = $date->format("j $month $year");
        }
        return $setdate;
    }

    public static function getStatusTh($status)
    {
        $result = DB::table('action_status')
            ->where('action_en', '=', $status)
            ->select('action_th')
            ->first();
        return $result->action_th;
    }

    public static function getAllDayName()
    {
        $thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
        return $thai_day_arr;
    }
    public static function getAllDayNameEN($key)
    {
        //$day_arr = array("จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์","อาทิตย์");
        $kDayKey = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        return $kDayKey[$key];
    }

    public static function getALlTimes()
    {
        $time_day_arr = array(
            '08:00',
            '08:30',
            '09:00',
            '09:30',
            '10:00',
            '10:30',
            '11:00',
            '11:30',
            '12:00',
            '12:30',
            '13:00',
            '13:30',
            '14:00',
            '14:30',
            '15:00',
            '15:30',
            '16:00',
            '16:30',
            '17:00',
            '17:30',
            '18:00',
            '18:30',
            '19:00',
            '19:30',
            '20:00',
            '20:30',
            '21:00',
            '21:30',
            '22:00'
        );

        return $time_day_arr;
    }

    public function getFullNameCmuAcount($email)
    {
        $result = User::where('email', $email)->first();
        if (!empty($result->positionName2)) {
            $prename = $result->positionName2;
        } else {
            $prename = $result->prename_TH;
        }
        $fullNames = $prename . "  " . $result->firstname_TH . " " . $result->lastname_TH;
        return $fullNames;
    }

    public function chkAddminRoomType($email)
    {
        $case = 0;
        $result = User::where('email', $email)->first();
        if ($result) {
            $case = (int) $result->is_case;
        }
        return $case;
    }

    public function getListDay($days)
    {
        $list = DB::table('listdays')->where('dayTitle', $days)->first();

        if ($list->id < 8) {
            $result = $list->dayList;
        } else {
            $temp = explode(",", $list->dayList);
        }

        $result = $list;
    }

    public function getduration($datetime1, $datetime2)
    {
        $datetime1 = (preg_match('/-/', $datetime1)) ? (int) strtotime($datetime1) : (int) $datetime1;
        $datetime2 = (preg_match('/-/', $datetime2)) ? (int) strtotime($datetime2) : (int) $datetime2;
        $duration = ($datetime2 >= $datetime1) ? $datetime2 - $datetime1 : $datetime1 - $datetime2;
        return $duration;
    }

    public function timeblock($time, $sc_numCol, $sc_timeStep)
    {
        //  global $sc_numStep;
        $sc_numStep = 60;
        $time = (preg_match('/:/', $time)) ? (int) strtotime($time) : (int) $time;
        for ($i_time = 0; $i_time < $sc_numCol - 1; $i_time++) {
            if ($time >= strtotime($sc_timeStep[$i_time]) && $time < strtotime($sc_timeStep[$i_time + 1])) {
                if ($time > strtotime($sc_timeStep[$i_time])) {
                    $duation = $this->getduration($time, strtotime($sc_timeStep[$i_time]));
                    $float_duration = ((($duation / 60) * 100) / $sc_numStep) * 0.01;
                    return $i_time + $float_duration;
                } else {
                    return $i_time;
                }
            }
        }
    }

    public function thai_date_short($time)
    {   // 19  ธ.ค. 2556 

        $monthTH = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $monthTH_brev = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        $thai_date_return = date("j", $time);
        $thai_date_return .= " " . $monthTH_brev[date("n", $time)];
        $thai_date_return .= " " . (date("Y", $time) + 543);
        return $thai_date_return;
    }
    public function convertDateSqlInsert($dates)
    {
        //15/07/2024
        $temp = explode('/', $dates);
        $result = $temp[2] . '-' . $temp[1] . '-' . $temp[0];
        return $result;
    }

    public function geturlCMUOauth($state)
    {
        $cmuKey = DB::table('tbl_apikey')
            ->select('clientID', 'clientSecret', 'redirect_uri')
            ->where('apiweb', '=', 'cmuoauth')
            ->first();

        $signwithCmu = 'https://oauth.cmu.ac.th/v1/Authorize.aspx?response_type=code&client_id=' . $cmuKey->clientID . '&redirect_uri=' . $cmuKey->redirect_uri . '&scope=cmuitaccount.basicinfo&state=' . $state;
        return $signwithCmu;
    }

    // ฟังก์ชันสำหรับการส่งข้อความ
    function sendMessageTOline($access_token, $message)
    {
        // ตั้งค่า Channel Access Token ของ LINE OA
        $channelToken = "Gt3FifuoPAiBzH+3F4aJpIQs8eazE7W5vwKbBKNaanHNBfH/WbFGauv25ocROsnTIsmGVhnCvxxgQUTveZmpmsxaA8hbOa2xVtgAA64QuKCRYqJGcK3/URRPsEYEUGT8i7tJwe6B1k25hhn7qHhQ9gdB04t89/1O/w1cDnyilFU="; // Replace with your token
        // สร้างข้อมูล JSON สำหรับส่งไปยัง LINE Messaging API

        // line Suttipong  
        //$access_token ="Uf6d4d223182dab6b3800a56fe5c6fa62";

        $data = [
            "to" => $access_token,  // ระบุปลายทาง (User ID หรือ Group ID)
            "messages" => [
                [
                    "type" => "text",
                    "text" => $message
                ]
            ]
        ];

        // เรียกใช้งาน API ด้วย cURL
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.line.me/v2/bot/message/push",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . $channelToken
            ],
            CURLOPT_POSTFIELDS => json_encode($data)
        ]);

        // รับผลลัพธ์จาก API
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        return $response;
    }


    public function getlineTokenAdminRoom($roomID, $typeAdmin)
    {
        $ListAdmin = "";
        if ((int) $typeAdmin == 2) {
            $sql = " 
          SELECT
            users.email,
            users.lineToken
            FROM `users`
            WHERE
            users.isAdmin = 1 AND
            users.user_type = 'admin'

        ";
            $ListAdmin = DB::select(DB::raw($sql));
        } else {
            $sql = " 
        SELECT
            admin_roooms.adminroom_type_id,
            admin_roooms.cmuitaccount,
            users.lineToken
            FROM
            admin_roooms
            INNER JOIN users ON admin_roooms.cmuitaccount = users.email
            WHERE
            admin_roooms.roomID ='{$roomID}' AND
            admin_roooms.adminroom_type_id = '{$typeAdmin}'
        ";
            $ListAdmin = DB::select(DB::raw($sql));
        }
        return $ListAdmin;
    }

    public function getAPIKEYPayment()
    {
        $token = '596e2bbe6d68d09d38e2a53addaeb1c7';
        return $token;
    }

    public function getEmailStepAcction($step)
    {
        $getEmailDean = DB::table('users')
            ->select('users.email')
            ->where('user_type', $step)
            ->get();
        return $getEmailDean[0]->email;
    }


    public function getendDateBooking()
    {
        $latestTerm = DB::table('terms')
            ->orderBy('id', 'desc') // เรียงลำดับจากมากไปน้อย
            ->first(); // ดึงแค่ 1 รายการ
        return $latestTerm->end_date;
    }

    // start_date / end_date
    public function getfinalBookingDate()
    {
        $latestTerm = DB::table('terms')
            ->orderBy('id', 'desc') // เรียงลำดับจากมากไปน้อย
            ->first(); // ดึงแค่ 1 รายการ
        return $latestTerm;
    }

    function getListNumOfDay($days)
    {
        $sql = "SELECT
                listdays.numofday
                FROM `listdays`
                WHERE
                ( listdays.dayTitle = '{$days}'  OR listdays.dayList = '{$days}' )  ";
        $resultlistdays = DB::select(DB::raw($sql));

        $result = $resultlistdays[0]->numofday;
        return $result;
    }

    function getDateofday($start_date, $end_date, $days)
    {
        // สร้าง Carbon objects สำหรับวันที่เริ่มต้นและสิ้นสุด
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);

        // อาร์เรย์เพื่อเก็บผลลัพธ์
        $result = [];
        if (!is_array($days)) {
            $days = explode(',', $days); // แปลงจาก string เป็น array (ถ้าต้องการส่งค่าเป็น string)
        }

        // Loop จนกระทั่งถึงวันที่สิ้นสุด
        while ($start->lte($end)) {
            // ตรวจสอบว่าวันนี้เป็นวัน $days (1,4)  คือวันจันทร์ และพฤหัสบดี 

            if (in_array($start->dayOfWeek, $days)) {
                $result[] = $start->toDateString();
            }
            // เพิ่มวันที่ทีละหนึ่งวัน
            $start->addDay();
        }
        return $result;
    }

    //function เช็คสิทธิการลงข้อมูล 
    function getUserStatusImportdata()
    {

        $email = Session::get('cmuitaccount');
        $status = 0;
        $onStartDate = '';
        $onEndDate = '';
        $currentDate = Carbon::today();
        $chkUser = adminGroupCourse::where('cmuitaccount', $email)->first();
        if ($chkUser) {
            if ($chkUser->count() > 0) {
                $groupCourse = $chkUser->courseId;

                // หาวันที่  ที่ลงได้ 
                $latestDate = DB::table('terms')
                    ->orderBy('id', 'desc') // เรียงลำดับจากมากไปน้อย
                    ->first(); // ดึงแค่ 1 รายการ
                if ($groupCourse == 1) {
                    $onStartDate = Carbon::parse($latestDate->group1_start);
                    $onEndDate = Carbon::parse($latestDate->group1_end);
                } else if ($groupCourse == 2) {
                    $onStartDate = Carbon::parse($latestDate->group2_start);
                    $onEndDate = Carbon::parse($latestDate->group2_end);
                } else if ($groupCourse == 3) {
                    $onStartDate = Carbon::parse($latestDate->group3_start);
                    $onEndDate = Carbon::parse($latestDate->group3_end);
                } else {
                    $status = 0;
                }
                if ($currentDate->between($onStartDate, $onEndDate)) {
                    $status = 1;
                    //echo "วันที่ปัจจุบันอยู่ในช่วง";
                } else {
                    $status = 0;
                    // echo "วันที่ปัจจุบันไม่อยู่ในช่วง";
                }
            }
        }
        return $status;
    }

    function convertTimeFormat($timeString)
    {
        // เติมเลขศูนย์ด้านหน้าให้ครบ 4 หลัก
        $timeString = str_pad($timeString, 4, "0", STR_PAD_LEFT);

        return Carbon::createFromFormat('Hi', $timeString)->format('H:i');
    }
}
