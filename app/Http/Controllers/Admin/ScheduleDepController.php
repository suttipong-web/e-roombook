<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ScheduleImport;
use App\Models\Listday;
use App\Models\Rooms;
use App\Models\roomSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use Excel;
use Session;

class ScheduleDepController extends Controller
{
    // 
    public function index(Request $request)
    {
        $nowYear = (date('Y')) + 543;
        $Byuser = $request->session()->get('cmuitaccount');

        $getliatday = DB::table('listdays')
            ->select('dayTitle', 'dayList')
            ->get();

        //ข้อมูลห้อง ทั้งหมด join
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->where('roomTypeId', '<>', '1')
            ->where('is_open', '1')
            ->get();

        //ข้อมูลห้องจองห่้องเรียน
        $BookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
            ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('room_schedules.is_confirm', 0)
            ->where('room_schedules.straff_account', $Byuser)
            ->get();

        foreach ($BookingList as $rows) {

            $is_duplicate = false;
            //ตรวจสอบว่าวันที่ เวลา มีคนการจองก่อนหน้าหรือยัง  
            //ถ้ามีให่  update  ฟิด is_duplicate = true  ด้วย เพื่อเป้นการแจ้งเตือน 
            //ตรวจสอบว่าจองเวลานี้ได้ไหม 

            //'schedule_startdate', 'schedule_enddate', 'booking_time_start', 'booking_time_finish'
            $bkstartdate = $rows->schedule_startdate;
            $bkwnddate = $rows->schedule_enddate;
            // เวลาเริ่ม จบ  
            $bkstart = $rows->booking_time_start;
            $bkfinish = $rows->booking_time_finish;

            //ตรวจสอบหาวัน /เวลานี้ว่ามีรายการซื้อไหม 
            $sql = " SELECT * FROM `room_schedules` WHERE
                    room_schedules.roomID ='" . $rows->roomID . "'  AND
                    room_schedules.schedule_startdate >= '" . $rows->schedule_startdate . "' AND 
                    room_schedules.schedule_enddate <='" . $rows->schedule_enddate . "'  AND   
                    room_schedules.schedule_repeatday = '" . $rows->schedule_repeatday . "' AND 
                    ( room_schedules.id <> '" . $rows->id . "' AND room_schedules.id > $rows->id)  AND 
                    room_schedules.is_duplicate = '0'
                    ORDER BY booking_time_start ASC
                    ";
            //echo  $sql;
            $qresult = DB::select(DB::raw($sql));
            if ($qresult) {
                foreach ($qresult as $row_chk) {
                    if (
                        ($bkstart >= $row_chk->booking_time_start && $bkstart < $row_chk->booking_time_finish)
                        ||
                        ($bkfinish > $row_chk->booking_time_start && $bkfinish <= $row_chk->booking_time_finish)
                        ||
                        ($bkstart < $row_chk->booking_time_start && $bkfinish > $row_chk->booking_time_finish)
                    ) {
                        //เวลาซ้ำ    
                        $result = DB::table('room_schedules')
                            /*       ->where('id', $rows->id)*/
                            ->where('id', $row_chk->id)
                            ->update([
                                'is_duplicate' => 1
                            ]);
                    }
                }
            }
        }


        $getBookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
            ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('room_schedules.is_confirm', 0)
            ->where('room_schedules.straff_account', $Byuser)
            ->get();

        return view('admin.schedule.index')->with([
            'getBookingList' => $getBookingList,
            'getListRoom' => $getListRoom,
            'nowYear' => $nowYear,
            'listDays' => $getliatday
        ]);
    }

    //Import file Excel to Database with call 
    public function saveImportfile(Request $request)
    {
        $cmuitaccount = $request->session()->get('cmuitaccount');
        Excel::import(new ScheduleImport, $request->file('fileupload'));
        return redirect()->back()->with('success', true);
    }

    //แสดงตารางเรียน
    public function views(Request $request)
    {
        return view('admin.schedule.showSchedule')->with([
            "TitlePage" => "แสดงรายกาาตารางเรียนของท่าน"
        ]);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $result = roomSchedule::find($id);
        if ($result) {
            roomSchedule::destroy($id);
        }
    }

    public function fetchall(Request $request)
    {
        $output = " ไม่พบรายการลงเวลาของท่าน ";
        // ส่วนของตัวแปรสำหรับกำหนด
        $dayTH = array("จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์", "อาทิตย์");
        $monthTH = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $monthTH_brev = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        $roomId = 0;
        $Byuser = $request->cmuaccount;
        if ($request->getroomId) {
            $roomId = $request->getroomId;
        }

        // หาห้องเรียนที่ User คนนี้ได้ทำการจองไว้ 
        $sql = "
            SELECT room_schedules.roomID , rooms.roomFullName,rooms.roomTitle ,room_schedules.courseofyear,room_schedules.terms
            FROM room_schedules
            INNER JOIN rooms ON room_schedules.roomID = rooms.id
            WHERE (room_schedules.straff_account = '" . $Byuser . "')  AND  (room_schedules.is_duplicate =0)  ";
        if ($roomId > 0) {
            $sql .= " AND ( room_schedules.roomID ='{$roomId}' ) ";
        }
        $sql .= "   ORDER BY  roomID  ASC ";
        $getRoom = DB::select(DB::raw($sql));

        //$getRoom = roomSchedule::Join('rooms', 'rooms.id', '=', 'room_schedules.roomID')
        // ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
        //  ->where('room_schedules.is_confirm', 0)
        // ->where('room_schedules.straff_account', $Byuser)
        //  ->get();
        $roomIdDisplay = 0;
        if ($getRoom) {
            //loop ตารางห้องเรียน  
            foreach ($getRoom as $tableRoom) {
                $output = "";
                ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                $sc_startTime = date("Y-m-d 08:00:00");  // กำหนดเวลาเริ่มต้ม เปลี่ยนเฉพาะเลขเวลา
                $sc_endtTime = date("Y-m-d 20:00:00");  // กำหนดเวลาสื้นสุด เปลี่ยนเฉพาะเลขเวลา
                $sc_t_startTime = strtotime($sc_startTime);
                $sc_t_endTime = strtotime($sc_endtTime);
                $sc_numStep = "60"; // ช่วงช่องว่างเวลา หน่ายนาที 60 นาที = 1 ชั่วโมง
                $num_dayShow = 7;  // จำนวนวันที่โชว์ 1 - 7
                $sc_timeStep = array();
                $sc_numCol = 0;
                $hour_block_width = 90;
                ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                $uts = "";
                if ($request->uts) {
                    $uts = $request->uts; // ถ้ามีส่งค่าเปลี่ยนสัปดาห์มา
                }
                // ส่วนของการกำหนดวัน สามารถนำไปประยุกต์กรณีทำตารางเวลาแบบ เลื่อนดูแต่ละสัปดาห์ได้
                $now_day = date("Y-m-d"); // วันปัจจุบัน ให้แสดงตารางที่มีวันปัจจุบัน เมื่อแสดงครั้งแรก
                if (isset($uts) && $uts != "") { // เมื่อมีการเปลี่ยนสัปดาห์
                    $now_day = date("Y-m-d", trim($uts)); // เปลี่ยนวันที่ แปลงจากค่าวันจันทร์ที่ส่งมา
                    $now_day = date("Y-m-d", strtotime($now_day . " monday this week"));
                }
                // หาตัวบวก หรือลบ เพื่อหาวันที่ของวันจันทร์ในสัปดาห์
                $start_weekDay = date("Y-m-d", strtotime("monday this week")); // หาวันจันทร์ของสัปดาห์
                if (isset($uts) && $uts != "") { // ถ้ามีส่งค่าเปลี่ยนสัปดาห์มา
                    $start_weekDay = $now_day; // ให้ใช้วันแรก เป็นวันที่ส่งมา
                }
                // หววันที่วันอาทิตย์ของสัปดาห์นั้นๆ
                $end_weekDay = date("Y-m-d", strtotime($start_weekDay . "+7 day"));
                $timestamp_prev = strtotime($start_weekDay . " -7 day"); // ค่าวันจันทร์ของอาทิตย์ก่อหน้า
                $timestamp_next = strtotime($start_weekDay . " +7 day"); // ค่าวันจันทร์ของอาทิตย์ถัดไป

                while ($sc_t_startTime <= $sc_t_endTime) {
                    $sc_timeStep[$sc_numCol] = date("H:i", $sc_t_startTime);
                    $sc_t_startTime = $sc_t_startTime + ($sc_numStep * 60);
                    $sc_numCol++;    // ได้จำนวนคอลัมน์ที่จะแสดง
                }
                ///////////////// ส่วนของข้อมูล ที่ดึงจากฐานข้อมูบ ////////////////////////
                $resultBooking = DB::select(DB::raw("
                    SELECT
                        room_schedules.*,
                        rooms.roomFullName,
                        rooms.roomTitle,
                        rooms.roomToken
                        FROM
                        room_schedules
                        INNER JOIN rooms ON room_schedules.roomID = rooms.id
                        WHERE 
                        (room_schedules.roomID  = '" . $tableRoom->roomID . "') AND   
                        (room_schedules.is_duplicate =0)  AND 
                        (room_schedules.straff_account = '" . $Byuser . "') AND 
                        (                       
                            (room_schedules.schedule_startdate  >= '" . $start_weekDay . "' AND schedule_startdate <  '" . $end_weekDay . "') OR
                            ('" . $start_weekDay . "' > schedule_startdate  AND schedule_enddate <  '" . $end_weekDay . "'  AND schedule_enddate >= '" . $start_weekDay . "' )  OR
                            ('" . $start_weekDay . "' > schedule_startdate  AND '" . $end_weekDay . "'  < schedule_enddate  AND schedule_enddate >= '" . $start_weekDay . "' ) 
                        )
                        ORDER BY  schedule_startdate ASC  
                    "));

                $data_schedule = array();
                if ($resultBooking) {
                    foreach ($resultBooking as $row) {
                        $repeat_day = ($row->schedule_repeatday != "") ? $row->schedule_repeatday : '';
                        $day1 = "";
                        $day2 = "";
                        $list = DB::table('listdays')->where('dayTitle', $row->schedule_repeatday)->first();
                        if ($list) {
                            if ($list->id < 8) {
                                $day1 = $list->dayList;
                            } else {
                                $temp = explode(",", $list->dayList);
                                $day1 = $temp[0];
                                $day2 = $temp[1];
                            }
                        }
                        $data_schedule[] = array(
                            "id" => $row->id,
                            "start_date" => $row->schedule_startdate,
                            "end_date" => $row->schedule_enddate,
                            "start_time" => $row->booking_time_start,
                            "end_time" => $row->booking_time_finish,
                            "repeat_day" => $day1,
                            "repeat_day2" => $day2,
                            "title" => $row->courseNO,
                            "sec" => $row->courseSec,
                            "room" => $row->roomFullName,
                            "isroomID" => $row->roomID,
                            "building" => $row->roomTitle
                        );
                    }
                }

                //echo print_r($data_schedule);

                $data_day_schedule = [];
                $checkDayKey = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                if (count($data_schedule) > 0) {
                    foreach ($data_schedule as $row) {
                        if (
                            (strtotime($row['start_date']) >= strtotime($start_weekDay) && strtotime($row['start_date']) < strtotime($end_weekDay))
                            || (strtotime($start_weekDay) > strtotime($row['start_date']) && strtotime($row['end_date']) < strtotime($end_weekDay)
                                && strtotime($row['end_date']) >= strtotime($start_weekDay))
                            || (strtotime($start_weekDay) > strtotime($row['start_date']) && strtotime($end_weekDay) < strtotime($row['end_date'])
                                && strtotime($row['end_date']) >= strtotime($start_weekDay))
                        ) {
                            if (!empty($row['repeat_day'])) { // have day repeat
                                for ($i = 0; $i < $num_dayShow; $i++) {
                                    if (strtotime($start_weekDay . " +" . $i . "day") >= strtotime($row['start_date']) && strtotime($start_weekDay . " +" . $i . " day") <= strtotime($row['end_date'])) {
                                        $dayKey = date("D", strtotime($start_weekDay . " +" . $i . " day"));
                                        $data_day_schedule[$dayKey][] = [
                                            "start_time" => $row['start_time'],
                                            "end_time" => $row['end_time'],
                                            "duration" => $this->getduration(strtotime($row['start_time']), strtotime($row['end_time'])),
                                            "timeblock" => $this->timeblock($row['start_time'], $sc_numCol, $sc_timeStep),
                                            "title" => $row['title'],
                                            "room" => $row['room'],
                                            "roomId" => $row['isroomID'],
                                            "building" => $row['building'],
                                            "sec" => $row['sec'],
                                            'UserChkDay' => $row['repeat_day'],
                                            'UserChkDay2' => $row['repeat_day2']
                                        ];
                                    }
                                }
                            } else { // else repeat all day
                                for ($i = 0; $i < $num_dayShow; $i++) {
                                    if (strtotime($start_weekDay . " +" . $i . " day") >= strtotime($row["start_date"]) && strtotime($start_weekDay . " +" . $i . "  day") <= strtotime($row["end_date"])) {
                                        $dayKey = date("D", strtotime($start_weekDay . " +" . $i . " day"));

                                        $data_day_schedule[$dayKey][] = [
                                            "start_time" => $row['start_time'],
                                            "end_time" => $row['end_time'],
                                            "duration" => $this->getduration(strtotime($row['start_time']), strtotime($row["end_time"])),
                                            "timeblock" => $this->timeblock($row["start_time"], $sc_numCol, $sc_timeStep),
                                            "title" => $row['title'],
                                            "room" => $row['room'],
                                            "roomId" => $row['isroomID'],
                                            "building" => $row['building'],
                                            "sec" => $row['sec'],
                                            'UserChkDay' => $row['repeat_day']
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }

                ///////////////// ส่วนของข้อมูล ที่ดึงจากฐานข้อมูบ ////////////////////////

                if ($roomIdDisplay <> $tableRoom->roomID) {
                    $roomIdDisplay = $tableRoom->roomID;
                    $output .= '

                        <div class="wrap_schedule_control mt-5">
                            <div class="d-flex">
                                <div class="text-left d-flex align-items-center">';
                    $num_dayShow_in_schedule = $num_dayShow - 1;
                    $output .= 'ตารางเรียนห้อง &nbsp&nbsp&nbsp<span class="badge badge-info"><h5>' . $tableRoom->roomFullName . '</h5> </span> &nbsp&nbsp&nbsp ช่วงวันที่ ' . $this->thai_date_short(strtotime($start_weekDay)) . ' ถึง ' . $this->thai_date_short(strtotime($start_weekDay . $num_dayShow_in_schedule . ' day')) . '</div>';
                    $output .= '  <div class="col-auto text-right ml-auto">';
                    $slc = '<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01"> ปีการศึกษา </label>
                                            </div>
                                        <select class="custom-select" id="sclcourseofyear">';
                    $cyear = '';
                    $terms = '';
                    //  รูปการศึกษา 
                    foreach ($getRoom as $item) {
                        if ($item->courseofyear != $cyear) {
                            $cyear = $item->courseofyear;
                            $terms = $item->terms;
                            $vals = $terms . "/" . $cyear;
                            $slc .= '<option value="' . $vals . '"> ' . $vals . '</option>';
                        }
                    }
                    $slc .= '   </select> ';

                    $output .= $slc . '  </div> 
                                    </div> 
                                <div class="col-auto text-right"> ';
                    $output .= '
                                    <button type="button" class="btn btn-secondary btn-sm btnUTS mR-2" valuts =' . $timestamp_prev . ' >< Prev </button>
                                    <button type="button" class="btn btn-secondary btn-sm btnUTS " valuts =' . $timestamp_next . ' >Next > </button>
                                    <button type="button" class="btn btn-primary btn-sm btnUTS ml-2" valuts ="" >Home </button>        
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="wrap_schedule">
                        <div class="table-responsive ">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr class="time_schedule">
                                        <th class="p-0">
                                            <div class="day-head-label text-right">
                                                เวลา
                                            </div>
                                            <div class="diagonal-cross"></div>
                                            <div class="time-head-label text-left">
                                                วัน
                                            </div>
                                        </th> ';
                    $timeHeardbar = "";
                    for ($i_time = 0; $i_time < $sc_numCol - 1; $i_time++) {
                        $timeHeardbar .= '<th class="px-0 text-nowrap th-time">
                                        <div class="time_schedule_text text-center" style="width:' . $hour_block_width . 'px;">
                                            ' . $sc_timeStep[$i_time] . ' - ' . $sc_timeStep[$i_time + 1] . '
                                        </div>   
                                    </th>';
                    }
                    $output .= $timeHeardbar . '</tr>
                                    </thead>
                                <tbody> ';
                    $outputBody = "";
                    // วนลูปแสดงจำนวนวันตามที่กำหนด
                    for ($i_day = 0; $i_day < $num_dayShow; $i_day++) {
                        $dayInSchedule_chk = date("Y-m-d", strtotime($start_weekDay . " +" . $i_day . " day"));
                        $dayKeyChk = date("D", strtotime($start_weekDay . " +" . $i_day . " day"));
                        //$dayInSchedule_show = date("d-m-Y", strtotime($start_weekDay . " +" . $i_day . " day"));
                        $dayInSchedule_show = $this->thai_date_short(strtotime($start_weekDay . " +" . $i_day . " day"));
                        $outputBody .= '<tr>
                                    <td class="p-0 text-center table-active">
                                        <div class="day_schedule_text text-nowrap" style="min-height: 60px;">
                                                ' . $dayTH[$i_day] . '<br>' . $dayInSchedule_show . '
                                        </div>
                                    </td>
                                    <td class="p-0 position-relative" colspan="12">
                                        <div class="position-absolute">
                                            <div class="d-flex align-content-stretch" style="min-height: 60px;">';
                        $inRowDay = "";
                        for ($i = 1; $i < $sc_numCol; $i++) {
                            $inRowDay .= '
                                            <div class="bg-light text-center border-right" style="width:' . $hour_block_width . 'px;margin-right: 1px;">
                                                &nbsp;
                                            </div>';
                        }
                        $outputBody .= '' . $inRowDay . '</div>
                                </div>
                                <div class="position-absolute" style="z-index: 100;">';
                      //  $strLop = "";
                        if (isset($data_day_schedule[$dayKeyChk]) && count($data_day_schedule[$dayKeyChk]) > 0) {
                            $lop = 0;
                            foreach ($data_day_schedule[$dayKeyChk] as $row_day) {
                                $lop++;
                                $sc_width = ($row_day['duration'] / 60) * ($hour_block_width / $sc_numStep);
                                $sc_start_x = $row_day['timeblock'] * $hour_block_width + (int) $row_day['timeblock'];
                                if (($dayKeyChk == $row_day['UserChkDay'] || $dayKeyChk == $row_day['UserChkDay2']) && ($row_day['roomId'] == $tableRoom->roomID)) {
                                    $outputBody .= '<div class="position-absolute text-center sc-detail" 
                                                    style="width: ' . $sc_width . 'px;margin-right: 1px;margin-left:' . $sc_start_x . 'px;min-height: 60px;">
                                                    <a href="#">' . $row_day['title'] . '</a><br/>sec ' . $row_day['sec'] . '<br>' . $row_day['room'] .
                                        '</div>';
                                }
                            }
                             //$outputBody .= "" . $strLop;
                        }
                        $outputBody .= ' </div></td></tr>';
                    }
                    $output .= '' . $outputBody . '</tbody></table></div></div>';
                    echo $output;
                }
            }
        } else {
            return $output;
        }
        //echo $output;
        // return $output;
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


    public function editSchedule(Request $request)
    {
        // $id = $request->id;        
        $result = roomSchedule::find($request->id);
        $result2 = json_encode($result);
        return response()->json([
            'status' => 200,
            'dataRoom' => $result2
        ]);
    }

    public function updated(Request $request)
    {
        $result = "";
        //ตรวจสอบรหัส ID ที่จะแก้ไขก่อน 

        $p_schedule_startdate = (isset($request->schedule_startdate)) ? $request->schedule_startdate : "0000-00-00";
        $p_schedule_enddate = (isset($request->schedule_enddate)) ? $request->schedule_enddate : "0000-00-00";
        $p_schedule_starttime = (isset($request->booking_time_start)) ? $request->booking_time_start : "00:00:00";
        $p_schedule_endtime = (isset($request->booking_time_finish)) ? $request->booking_time_finish : "00:00:00";
        $p_schedule_repeatday = (isset($request->schedule_repeatday)) ? $request->schedule_repeatday : "";

        $setData = [
            'courseNO' => $request->courseNO,
            'courseTitle' => $request->courseTitle,
            'courseSec' => $request->courseSec,
            'Stdamount' => $request->Stdamount,
            'booking_time_start' => $p_schedule_starttime,
            'booking_time_finish' => $p_schedule_endtime,
            'roomID' => $request->roomID,
            'lecturer' => $request->lecturer,
            'description' => $request->description,
            'staffupdated' => Carbon::now(),
            'straff_account' => $request->adminAccount,
            'schedule_startdate' => $p_schedule_startdate,
            'schedule_enddate' => $p_schedule_enddate,
            'schedule_repeatday' => $p_schedule_repeatday,
            'courseofyear' => $request->courseofyear,
            'terms' => $request->terms
        ];

        $result = roomSchedule::find($request->id);
        if ($result) {
            $result->update($setData);
            return response()->json([
                'status' => 200,
                'data' => $setData
            ]);
        }
        return response()->json([
            'status' => 208,
            'msg' => compact($result)
        ]);
    }
    public function insertSchedule(Request $request)
    {


        $p_schedule_startdate = (isset($request->schedule_startdate)) ? $request->schedule_startdate : "0000-00-00";
        $p_schedule_enddate = (isset($request->schedule_enddate)) ? $request->schedule_enddate : "0000-00-00";
        $p_schedule_starttime = (isset($request->booking_time_start)) ? $request->booking_time_start : "00:00:00";
        $p_schedule_endtime = (isset($request->booking_time_finish)) ? $request->booking_time_finish : "00:00:00";
        $p_schedule_repeatday = (isset($request->schedule_repeatday)) ? $request->schedule_repeatday : "";


        //03/07/2024
        //$dstart = explode('/', $p_schedule_startdate);
        // $dend = explode('/', $p_schedule_enddate);

        // $dateStart = $dstart[2] . '-' . $dstart[1] .'-'. $dstart[0];
        //$dateEnd = $dend[2] . '-' . $dend[1].'-'.  $dend[0];


        // $p_schedule_allday = (isset($_POST['schedule_allday']))?1:0;


        //ตรวจสอบว่าจองเวลานี้ได้ไหม 
        /* $ChkTimeBookig = DB::table('room_schedules')
             ->select('booking_time_start', 'booking_time_finish')
             ->where('room_schedules.roomID', $request->roomID)
             ->where('room_schedules.schedule_startdate', $p_schedule_startdate )
             ->whereIn('room_schedules.p_schedule_repeatday',$p_schedule_repeatday)
             ->get();

         // เวลาเริ่ม 
         $bkstart = $request->booking_time_start;
         // เวลาสิ้สสุด
         $bkfinish = $request->booking_time_finish;
         $error = true;
         foreach ($ChkTimeBookig as $row_chk) {
             if (
                 ($bkstart >= $row_chk->booking_time_start && $bkstart < $row_chk->booking_time_finish)
                 ||
                 ($bkfinish > $row_chk->booking_time_start && $bkfinish <= $row_chk->booking_time_finish)
                 ||
                 ($bkstart < $row_chk->booking_time_start && $bkfinish > $row_chk->booking_time_finish)
             ) {
                 return response()->json([
                     'status' => 208,
                     'text' => 'มีรายการจองของวันนี้แล้ว'
                 ]);
                 $error = false;
             }
         }
      */
        $setDataBooking = [
            'courseNO' => $request->courseNO,
            'courseTitle' => $request->courseTitle,
            'courseSec' => $request->courseSec,
            'Stdamount' => $request->Stdamount,
            'booking_time_start' => $p_schedule_starttime,
            'booking_time_finish' => $p_schedule_endtime,
            'roomID' => $request->roomID,
            'lecturer' => $request->lecturer,
            'description' => $request->description,
            'staffupdated' => Carbon::now(),
            'straff_account' => $request->adminAccount,
            'schedule_startdate' => $p_schedule_startdate,
            'schedule_enddate' => $p_schedule_enddate,
            'schedule_repeatday' => $p_schedule_repeatday,
            'courseofyear' => $request->courseofyear,
            'terms' => $request->terms
        ];

        $success = roomSchedule::create($setDataBooking);
        if ($success) {
            return response()->json([
                'status' => 200,
                'msg' => $setDataBooking
            ]);
        } else {
            return response()->json([
                'alert' => compact($success)
            ]);
        }
    }
}
