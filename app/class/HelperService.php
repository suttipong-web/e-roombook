<?php

namespace App\class;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HelperService
{
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
        $date = Carbon::parse($arg);
        $month = $thai_months[$date->month];
        $year = $date->year + 543;
        if ($istime) {
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
        return   $result->action_th;
    }

    public static function getAllDayName()
    {
        $thai_day_arr = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
        return   $thai_day_arr;
    }
    public static function getAllDayNameEN($key)
    {
        //$day_arr = array("จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์","อาทิตย์");
        $kDayKey = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        return   $kDayKey[$key];
    }
    public static function getALlTimes()
    {
        $time_day_arr = array(
            '08:00', '08:00', '08:30', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00'
        );

        return   $time_day_arr;
    }
    public  function getFullNameCmuAcount($email)
    {
        $result =  User::where('email', $email)->first();
        $fullNames =  $result->prename_TH . "" . $result->firstname_TH . " " . $result->lastname_TH;
        return  $fullNames;
    }

    public function  getListDay($days)
    {
        $list = DB::table('listdays')->where('dayTitle', $days)->first();

        if ($list->id < 8) {
            $result = $list->dayList;
        } else {
            $temp = explode(",", $list->dayList);
        }

        $result =  $list;
    }

    function getduration($datetime1, $datetime2)
    {
        $datetime1 = (preg_match('/-/', $datetime1)) ? (int) strtotime($datetime1) : (int) $datetime1;
        $datetime2 = (preg_match('/-/', $datetime2)) ? (int) strtotime($datetime2) : (int) $datetime2;
        $duration = ($datetime2 >= $datetime1) ? $datetime2 - $datetime1 : $datetime1 - $datetime2;
        return $duration;
    }

    function timeblock($time, $sc_numCol, $sc_timeStep)
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

    function thai_date_short($time)
    {   // 19  ธ.ค. 2556 

        $monthTH = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $monthTH_brev = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        $thai_date_return = date("j", $time);
        $thai_date_return .= " " . $monthTH_brev[date("n", $time)];
        $thai_date_return .= " " . (date("Y", $time) + 543);
        return $thai_date_return;
    }
}