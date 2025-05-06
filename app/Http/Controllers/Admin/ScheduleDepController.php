<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ScheduleImport;
use App\Models\booking_rooms;
use App\Models\jop_booking;
use App\Models\Listday;
use App\Models\Rooms;
use App\Models\roomSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use Excel;
use Session;
use App\class\HelperService;
use App\Jobs\ProcessBooking;
use App\Jobs\UpdateRoomSchedule;
use Illuminate\Support\Str;

class ScheduleDepController extends Controller
{
    // 
    public function index(Request $request)
    {
        $class = new HelperService();
        $sesid = $request->ses_id;
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
        //echo  $sesid;
        $BookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
            ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('room_schedules.straff_account', $Byuser)
            ->where('room_schedules.is_group_session', $sesid)
            ->where('room_schedules.is_public', 0)
            ->where('is_error_room', 0)
            ->get();

        foreach ($BookingList as $rows) {

            $is_duplicate = 0;
            //ตรวจสอบว่าวันที่ เวลา มีคนการจองก่อนหน้าหรือยัง  
            //ถ้ามีให่  update  ฟิด is_duplicate = true  ด้วย เพื่อเป้นการแจ้งเตือน 
            //ตรวจสอบว่าจองเวลานี้ได้ไหม 

            //'schedule_startdate', 'schedule_enddate', 'booking_time_start', 'booking_time_finish'
            $bkstartdate = $rows->schedule_startdate;
            $bkwnddate = $rows->schedule_enddate;
            // เวลาเริ่ม จบ  
            $bkstart = $rows->booking_time_start;
            $bkfinish = $rows->booking_time_finish;

            // ตรวจสอบหาวัน /เวลานี้ว่ามีรายการจองหรือไม่
            $sql = "SELECT * FROM `room_schedules` WHERE
                    room_schedules.roomID = ?
                    AND (
                        (
                            DATE(room_schedules.schedule_startdate) <= DATE(?)
                            AND DATE(room_schedules.schedule_enddate) >= DATE(?)
                        )
                    )
                    AND room_schedules.schedule_repeatday = ?
                    AND room_schedules.id <> ?
                    ORDER BY booking_time_start ASC";

            $qresult = DB::select($sql, [
                $rows->roomID,
                $rows->schedule_startdate,
                $rows->schedule_enddate,
                $rows->schedule_repeatday,
                $rows->id
            ]);

            $isDuplicate = false;
            $strError = "";
            $timesBlock = "";
            $startTime_ = "";
            $finishTime_ = "";
            foreach ($qresult as $row_chk) {
                if (
                    ($bkstart < $row_chk->booking_time_finish && $bkfinish > $row_chk->booking_time_start)
                ) {
                    $startTime_ = Carbon::parse($row_chk->booking_time_start)->format('H:i'); // แปลงเป็น 14:00
                    $finishTime_ = Carbon::parse($row_chk->booking_time_finish)->format('H:i'); // แปลงเป็น 16:00
                    $timesBlock = $startTime_ . " - " . $finishTime_ . " น.";
                    $strError = "<b>ห้อง : " . $rows->roomFullName . "<br>ช่วงเวลา : " . $timesBlock . " <br> ถูกจองแล้วโดย: รหัสวิชา " . $row_chk->courseNO . " (" . $row_chk->courseSec . ") <br/>โปรดแก้ไขรายการจองของท่าน</b>";
                    $isDuplicate = true;
                    break;
                }
            }

            DB::table('room_schedules')->where('id', $rows->id)->update([
                'is_duplicate' => $isDuplicate ? 1 : 0,
                'is_error' => $isDuplicate ? 'ไม่สามารถลงเวลาได้' : '',
                'is_error_detail' => $strError
            ]);


            //ตรวจสอบในตารางการจองหลัก 
            // ตรวจสอบในตารางจริง
            $numofday = $class->getListNumOfDay($rows->schedule_repeatday);
            //echo "<br/>".$numofday;
            $loopdate = $class->getDateofday($rows->schedule_startdate, $rows->schedule_enddate, $numofday);
            // echo print_r($loopdate);                                            
            $error = 1;
            foreach ($loopdate as $is_date) {
                //ตรวจสอบว่าจองเวลานี้ได้ไหม         
                $ChkTimeBookig = DB::table('booking_rooms')
                    ->select('booking_time_start', 'booking_time_finish')
                    ->where('booking_rooms.roomID', $rows->roomID)
                    ->where('booking_rooms.booking_status', 1)
                    ->where('booking_rooms.schedule_startdate', '>=', $is_date)
                    ->where('booking_rooms.schedule_enddate', '<=', $is_date)
                    ->get();
                // ยืนยันการจอง
                $is_confirm = 1;
                $text = "";

                foreach ($ChkTimeBookig as $row_chk) {

                    $rowchkStart = str_replace(':', '', substr($row_chk->booking_time_start, 0, 5));
                    $rowchkEnd = str_replace(':', '', substr($row_chk->booking_time_finish, 0, 5));
                    // echo "<br/>".$rows->booking_time_start;
                    if (
                        ($rows->booking_time_start >= $rowchkStart && $rows->booking_time_start < $rowchkEnd)
                        ||
                        ($rows->booking_time_finish > $rowchkStart && $rows->booking_time_finish <= $rowchkEnd)
                        ||
                        ($rows->booking_time_start < $rowchkStart && $rows->booking_time_finish > $rowchkEnd)
                    ) {
                        $error = 0;
                    }
                }
            }
            if (!$error) {
                //เวลาซ้ำ    
                $result = DB::table('room_schedules')
                    ->where('id', $rows->id)
                    ->update([
                        'is_duplicate' => 1,
                        'is_error' => 'ไม่สามารถลงเวลาได้'
                    ]);
            }
        }


        $getBookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
            ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('room_schedules.straff_account', $Byuser)
            ->where('room_schedules.is_group_session', $sesid)
            ->orderBy('room_schedules.is_duplicate', 'DESC')
            ->get();

        return view('admin.schedule.index')->with([
            'getBookingList' => $getBookingList,
            'getListRoom' => $getListRoom,
            'nowYear' => $nowYear,
            'listDays' => $getliatday,
            'step' => $request->step,
            'sesionId' => $sesid
        ]);
    }


    //Import file Excel to Database with call 
    public function saveImportfile(Request $request)
    {

        $ses_id = session()->getId();
        $cmuitaccount = $request->session()->get('cmuitaccount');
        Excel::import(new ScheduleImport, $request->file('fileupload'));
        // return redirect()->back()->with('success', true);
        return redirect()->to('/admin/schedules/updated/' . $ses_id);
    }
    //แสดงตารางเรียน
    public function views(Request $request)
    {
        return view('admin.schedule.showSchedule')->with([
            "TitlePage" => "แสดงรายการตารางเรียนของท่าน"
        ]);
    }
    public function viewAll(Request $request)
    {
        return view('admin.schedule.viewAllSchedule')->with([
            "TitlePage" => "แสดงรายการตารางเรียนทั้งหมด"
        ]);
    }



    public function delete(Request $request)
    {
        $id = $request->id;
        $result = roomSchedule::find($id);
        if ($result) {
            //
            $sid = $result->is_group_session;
            $roomID = $result->roomID;
            $courseofyear = $result->courseofyear;
            $terms = $result->terms;
            $courseNO = $result->courseNO;
            $courseSec = $result->courseSec;

            if ($result->is_public) {
                // ลบข้อมูลใยคารางสอน  booking_rooms
                DB::table('booking_rooms')
                    ->where('import_sid', $sid)
                    ->where('roomID', $roomID)
                    ->where('courseNo', $courseNO)
                    ->where('booking_subject_sec', $courseSec)
                    ->delete();
            }
            // ลบข้อมูลในคารางสอน  room_schedules
            roomSchedule::destroy($id);
        }
    }

    public function delete_import(Request $request)
    {
        if (!empty($request->sid)) {
            // ลบข้อมูลตาราง import
            DB::table('room_schedules')->where('is_group_session', $request->sid)->delete();
            // ลบข้อมูลตารางจองห้อง
            DB::table('booking_rooms')->where('import_sid', $request->sid)->delete();
        }
    }
    public function fetchall(Request $request)
    {
        $class = new HelperService();
        $output = " ไม่พบรายการลงเวลาของท่าน ";

        $Byuser = "";
        // ส่วนของตัวแปรสำหรับกำหนด
        $dayTH = array("จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์", "อาทิตย์");
        $monthTH = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $monthTH_brev = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        $roomId = 0;
        if (!empty($request->cmuaccount)) {
            $Byuser = $request->cmuaccount;
        }
        if ($request->getroomId) {
            $roomId = $request->getroomId;
        }

        // หาห้องเรียนที่ User คนนี้ได้ทำการจองไว้ 

       
        if (!empty($Byuser)) {
            $sql = "
            SELECT room_schedules.roomID , 
            rooms.roomFullName,rooms.roomTitle,rooms.roomTypeId ,room_schedules.courseofyear,room_schedules.terms
            FROM room_schedules
            INNER JOIN rooms ON room_schedules.roomID = rooms.id  
            WHERE  (room_schedules.is_public =1) 
            ";
            $sql .= "
            AND (room_schedules.straff_account = '{$Byuser}')   
            ";
        } else{
            $sql = "
            SELECT rooms.id as roomID ,rooms.roomFullName,rooms.roomTitle,rooms.roomTypeId 
            FROM rooms          
            WHERE  (rooms.is_open =1)  AND  rooms.roomTypeId <> 1
            ";
        }

        $sql .= " GROUP BY  rooms.id  ORDER BY   rooms.id ASC ";
        $getRoom = DB::select(DB::raw($sql));
       // echo $sql."<br/>";
        //$getRoom = roomSchedule::Join('rooms', 'rooms.id', '=', 'room_schedules.roomID')
        // ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
        //  ->where('room_schedules.is_confirm', 0)
        // ->where('room_schedules.straff_account', $Byuser)
        //  ->get();

        $roomIdDisplay = 0;
        $roomTypeId = 0;

        if ($getRoom) {
            //loop ตารางห้องเรียน  
            foreach ($getRoom as $tableRoom) {

                $roomTypeId = $tableRoom->roomTypeId;
                $output = "";
                ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                $sc_startTime = date("Y-m-d 08:00:00");  // กำหนดเวลาเริ่มต้ม เปลี่ยนเฉพาะเลขเวลา
                $sc_endtTime = date("Y-m-d  22:00:00");  // กำหนดเวลาสื้นสุด เปลี่ยนเฉพาะเลขเวลา
                $sc_t_startTime = strtotime($sc_startTime);
                $sc_t_endTime = strtotime($sc_endtTime);

                $num_dayShow = 7;  // จำนวนวันที่โชว์ 1 - 7
                $sc_timeStep = array();
                $sc_numCol = 0;
                $sc_numStep = "60"; // ช่วงช่องว่างเวลา หน่ายนาที 60 นาที = 1 ชั่วโมง
                $hour_block_width = 90;

                ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                $uts = "";
                if ($request->uts) {
                    $uts = $request->uts; // ถ้ามีส่งค่าเปลี่ยนสัปดาห์มา
                }
                // ส่วนของการกำหนดวัน สามารถนำไปประยุกต์กรณีทำตารางเวลาแบบ เลื่อนดูแต่ละสัปดาห์ได้
                $now_day = date("Y-m-d"); // วันปัจจุบัน ให้แสดงตารางที่มีวันปัจจุบัน เมื่อแสดงครั้งแรก
                if (isset($uts) && $uts != "" && $uts != 0) { // เมื่อมีการเปลี่ยนสัปดาห์
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

                /* $sql = "
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
                        ( room_schedules.is_public =1)  AND 
                        (room_schedules.straff_account = '{$Byuser}') AND 
                        (                       
                            (room_schedules.schedule_startdate  >= '" . $start_weekDay . "' AND schedule_startdate <  '" . $end_weekDay . "') OR
                            ('" . $start_weekDay . "' > schedule_startdate  AND schedule_enddate <  '" . $end_weekDay . "'  AND schedule_enddate >= '" . $start_weekDay . "' )  OR
                            ('" . $start_weekDay . "' > schedule_startdate  AND '" . $end_weekDay . "'  < schedule_enddate  AND schedule_enddate >= '" . $start_weekDay . "' ) 
                        )
                        ORDER BY  schedule_startdate ASC  
                    " ;
                //echo  $sql;*/



                ///////////////// ส่วนของข้อมูล ที่ดึงจากฐานข้อมูล ////////////////////////
                $sql = " SELECT booking_rooms.*,rooms.roomFullName,rooms.roomTitle,rooms.roomToken
                        FROM booking_rooms
                        INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                        WHERE booking_rooms.roomID = '{$tableRoom->roomID}' 
                        AND  booking_rooms.booking_status =1
                        AND  booking_rooms.is_import_excel =1 ";
                if (!empty($Byuser)) {
                    $sql .= "
                            AND (booking_rooms.booker_cmuaccount = '{$Byuser}')   
                        ";
                }


                $sql .= " 
                        AND (
                            (schedule_startdate  >= '" . $start_weekDay . "' AND schedule_startdate <  '" . $end_weekDay . "') OR
                            ('" . $start_weekDay . "' > schedule_startdate  AND schedule_enddate <  '" . $end_weekDay . "'  AND schedule_enddate >= '" . $start_weekDay . "' )  OR
                            ('" . $start_weekDay . "' > schedule_startdate  AND '" . $end_weekDay . "'  < schedule_enddate  AND schedule_enddate >= '" . $start_weekDay . "' ) 
                            )
                        ORDER BY
                        booking_rooms.booking_date ASC
                        ";
                //exit;
                // echo  $tableRoom->roomID."<br/>".$sql."<br/>";
                //$resultBooking = DB::select(DB::raw($sql));

                $data_schedule = array();
                $resultBooking = DB::select(DB::raw($sql));

                $data_schedule = array();
                if ($resultBooking) {
                    foreach ($resultBooking as $row) {
                        $carbonDate = Carbon::parse($row->schedule_startdate);
                        $repeat_day = $carbonDate->format('D');
                        $day1 = "";
                        $day2 = "";
                        //$repeat_day = '2';
                        // $repeat_day = ($row['schedule_repeatday'] != "") ? explode(",", $row['schedule_repeatday']) : [];
                        $data_schedule[] = array(
                            "id" => $row->id,
                            "start_date" => $row->schedule_startdate,
                            "end_date" => $row->schedule_enddate,
                            "start_time" => $row->booking_time_start,
                            "end_time" => $row->booking_time_finish,
                            "repeat_day" => $repeat_day,
                            "title" => $row->booking_subject,
                            "depName" => $row->booking_department,
                            "sec" => $row->booking_booker,
                            "room" => $row->roomFullName,
                            "isroomID" => $row->roomID,
                            "booking_phone" => $row->booking_phone,
                            "building" => $row->roomTitle,
                            "Instructor" => $row->booking_Instructor,
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
                                            "start_date" => $row['start_date'],
                                            "start_time" => $row['start_time'],
                                            "end_time" => $row['end_time'],
                                            "duration" => $class->getduration(strtotime($row['start_time']), strtotime($row['end_time'])),
                                            "timeblock" => $class->timeblock($row['start_time'], $sc_numCol, $sc_timeStep),
                                            "title" => $row['title'],
                                            "room" => $row['room'],
                                            "roomId" => $row['isroomID'],
                                            "sec" => $row['sec'],
                                            "depName" => $row['depName'],
                                            "booking_phone" => $row['booking_phone'],
                                            'UserChkDay' => $row['repeat_day'],
                                            'Instructor' => $row['Instructor']
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


                    $linkPrint = '/room/print/' . $tableRoom->roomID . '/' . (int) $uts . '/' . $tableRoom->roomTitle;
                    $num_dayShow_in_schedule = $num_dayShow - 1;

                    $output .= '

                        <div class="wrap_schedule_control mt-5">
                            <div class="d-flex">
                                <div class="text-left d-flex align-items-center">';
                    $num_dayShow_in_schedule = $num_dayShow - 1;
                    $output .= 'ตารางเรียนห้อง &nbsp&nbsp&nbsp<span class="badge badge-info"><h5>' . $tableRoom->roomFullName . '</h5> </span> &nbsp&nbsp&nbsp ช่วงวันที่ ' . $this->thai_date_short(strtotime($start_weekDay)) . ' ถึง ' . $this->thai_date_short(strtotime($start_weekDay . $num_dayShow_in_schedule . ' day')) . '</div>';
                    $output .= '  <div class="col-auto text-right ml-auto">';
                    $slc = '<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="sclcourseofyear' . $tableRoom->roomID . '"> ปีการศึกษา </label>
                                            </div>     
                                    </div> 
                                <div class="col-auto text-right"> ';
                    $output .= '
                                    <button type="button" class="btn btn-secondary btn-sm btnUTS mR-2" valuts =' . $timestamp_prev . ' >< Prev </button>
                                    <button type="button" class="btn btn-secondary btn-sm btnUTS " valuts =' . $timestamp_next . ' >Next > </button>
                                    <button type="button" class="btn btn-primary btn-sm btnUTS ml-2" valuts ="" >Home </button>   
                                      <a class="btn btn-danger btn-sm btnPrint- ml-2" href=' . $linkPrint . '  target="_blank"><i class="bi bi-printer"></i></a>      
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="wrap_schedule">
                        <div class="table-responsive ">
                            <table class="table bg-light table-borderless ">
                                <thead class="thead-light">
                                    <tr class="time_schedule" >
                                        <th class="p-0 border-right " style="max-width:' . $hour_block_width . 'px;">
                                            <div class="day-head-label text-right text-end" >
                                                เวลา
                                            </div>
                                            <div class="diagonal-cross"></div>
                                            <div class="time-head-label text-left">
                                                วัน
                                            </div>
                                        </th> ';
                    $timeHeardbar = "";
                    for ($i_time = 0; $i_time < $sc_numCol - 1; $i_time++) {
                        $timeHeardbar .= '<th class="px-0 text-nowrap th-time  border-right"  style="max-width:' . $hour_block_width . 'px;">
                                        <div class="time_schedule_text text-center" style="width:' . $hour_block_width . 'px;">
                                            ' . $sc_timeStep[$i_time] . ' - ' . $sc_timeStep[$i_time + 1] . '
                                        </div>   
                                    </th>';
                    }
                    $output .= $timeHeardbar . '</tr>
                                    </thead>
                                <tbody > ';
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
                                    <td class="p-0 position-relative" >
                                        <div class="position-absolute">
                                            <div class="d-flex align-content-stretch" style="min-height: 60px;">';
                        $inRowDay = "";
                        for ($i = 1; $i < $sc_numCol; $i++) {
                            $inRowDay .= '
                                            <div class="bg-light- text-center  style="width:' . $hour_block_width . 'px;margin-right: 0px;">
                                                &nbsp;
                                            </div>';
                        }
                        $outputBody .= '' . $inRowDay . '</div>
                                </div>
                                <div class="position-absolute" style="z-index: 100;">';
                        //  $strLop = "";
                        if (isset($data_day_schedule[$dayKeyChk]) && count($data_day_schedule[$dayKeyChk]) > 0) {
                            foreach ($data_day_schedule[$dayKeyChk] as $row_day) {

                                $percenStr = 2.6;
                                $scalx = 0;
                                $difx = 0;

                                $sc_width = ($row_day['duration'] / 60) * ($hour_block_width / $sc_numStep);
                                $sc_start_x = $row_day['timeblock'] * $hour_block_width + (int) $row_day['timeblock'];
                                $strlen = Str::length($row_day['title']);
                                $scaly = ($sc_width / $strlen);
                                if (($sc_width / 60) >= 3.75) {
                                    $difx = ((int) ($sc_width / 60)) + 1;
                                    $scalx = ($sc_width / 60) - $difx;
                                    $percenStr = $percenStr + (int) $scalx;
                                }

                                if ($scaly <= $percenStr) {
                                    $subjectTitle = Str::limit($row_day['title'], ($sc_width / $percenStr), '...');
                                } else {
                                    $subjectTitle = $row_day['title'];
                                }

                                $sub2 = "";
                                if ($roomTypeId > 1) {
                                    $sub2 = "<br/>" . $row_day['Instructor'];
                                }

                                $details = '<div> วันที่ ' . $class->convertDateThaiNoTime($row_day['start_date'], 1) . ' ช่วงเวลา : ' . Str::limit($row_day['start_time'], 5, '') . '-' . Str::limit($row_day['end_time'], 5, '') . ' <br/> ผู้สอน : ' . $row_day["sec"] . '<br/> ' . $row_day["depName"] . ' </div>';
                                $outputBody .= '<div class="position-absolute text-center  sc-detail-std" 
                                detail="' . $details . '"
                                htitle ="' . $row_day['title'] . '"
                               style="width: ' . $sc_width . 'px;margin-right: 1px;margin-left:' . $sc_start_x . 'px;min-height: 60px;">
                               <a href="#" title ="' . $row_day['title'] . '" >' . $subjectTitle . $sub2 . '</a></div>';
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

    // insertCorusetoTablebooking  นำข้อมูลไปลงในตาราง table จริงๆ 

    public function insertCorusetoTablebooking(Request $request)
    {
        $class = new HelperService();
        $Byuser = $request->session()->get('cmuitaccount');
        $strerror = [];
        $setDataBooking = [];
        $sessionId = $request->token;
        ///////////////// ส่วนของข้อมูล ที่ดึงจากฐานข้อมูบ ////////////////////////
        $sql = "
                    SELECT
                        room_schedules.*,
                        rooms.roomFullName,
                        rooms.roomTitle,
                        rooms.roomToken
                        FROM
                        room_schedules
                        INNER JOIN rooms ON room_schedules.roomID = rooms.id
                        WHERE                        
                        (room_schedules.is_error_room =0)  AND 
                        (room_schedules.is_duplicate =0)  AND 
                        (room_schedules.is_public =0)  AND 
                        (room_schedules.admin_confirm= 0)  AND 
                        (room_schedules.straff_account = '{$Byuser}')    
                        AND (  room_schedules.is_group_session= '{$sessionId}' )                 
                        ORDER BY  schedule_startdate ASC  
                    ";


        $resultBooking = DB::select(DB::raw($sql));
        // echo $sql ;
        $data_schedule = array();
        if ($resultBooking) {

            $booking_subject = "";
            foreach ($resultBooking as $row) {
                //echo $row->schedule_repeatday;

                $numofday = $class->getListNumOfDay($row->schedule_repeatday);
                //  echo "<br/>".$numofday;
                $loopdate = $class->getDateofday($row->schedule_startdate, $row->schedule_enddate, $numofday);
                // echo print_r($loopdate);
                // insert 
                $roomID = $row->roomID;


                $booking_subject = $row->courseNO . "(" . $row->courseSec . ") \n" . $row->courseTitle;
                $booking_department = "";
                $subIDError = "";
                $courseNO = $row->courseNO;

                foreach ($loopdate as $is_date) {

                    //ตรวจสอบว่าจองเวลานี้ได้ไหม         
                    $ChkTimeBookig = DB::table('booking_rooms')
                        ->select('booking_time_start', 'booking_time_finish')
                        ->where('booking_rooms.roomID', $roomID)
                        ->where('booking_rooms.booking_status', 1)
                        ->where('booking_rooms.schedule_startdate', '>=', $is_date)
                        ->where('booking_rooms.schedule_enddate', '<=', $is_date)
                        ->get();

                    // ยืนยันการจอง
                    $is_confirm = 1;
                    $text = "";
                    $error = 1;

                    foreach ($ChkTimeBookig as $row_chk) {

                        $rowchkStart = str_replace(':', '', substr($row_chk->booking_time_start, 0, 5));
                        $rowchkEnd = str_replace(':', '', substr($row_chk->booking_time_finish, 0, 5));

                        if (
                            ($row->booking_time_start >= $rowchkStart && $row->booking_time_start < $rowchkEnd)
                            ||
                            ($row->booking_time_finish > $rowchkStart && $row->booking_time_finish <= $rowchkEnd)
                            ||
                            ($row->booking_time_start < $rowchkStart && $row->booking_time_finish > $rowchkEnd)
                        ) {
                            $error = 0;
                            $is_confirm = 0;
                        }
                    }

                    //   if (!empty($is_date)) {
                    if ($error) {
                        //  echo "is_date=>".$is_date;
                        $no = time();
                        $bookingToken = md5(time());
                        $setDataBooking[] = [
                            'booking_no' => $no,
                            'bookingToken' => $bookingToken,
                            'roomID' => $row->roomID,
                            'booking_date' => $is_date,
                            'booking_time_start' => $row->booking_time_start,
                            'booking_time_finish' => $row->booking_time_finish,
                            'booking_subject' => $booking_subject,
                            'booking_booker' => $row->lecturer,
                            'booking_Instructor' => $row->lecturer,
                            'booking_ofPeople' => (int) ($row->Stdamount ?? 0),
                            'booking_department' => $booking_department,
                            'schedule_startdate' => $is_date,
                            'schedule_enddate' => $is_date,
                            'booking_phone' => '',
                            'booking_email' => '',
                            'booker_cmuaccount' => $Byuser,
                            'description' => '',
                            'booking_type' => 'eng',
                            'booking_at' => Carbon::now(),
                            'booking_fileurl' => '',
                            'booking_status' => '1',
                            'booking_code_cancel' => 'engit',
                            'courseofyear' => $row->courseofyear,
                            'terms' => $row->terms,
                            'is_import_excel' => '1',
                            'courseNo' => $row->courseNO,
                            'booking_subject_sec' => $row->courseSec,
                            'import_sid' => $row->is_group_session 
                        ];

                        //$result = booking_rooms::create($setDataBooking);  

                        //  UPDATE  status id complete insert table 
                        //DB::table('room_schedules')->where('id', $row->id)->update(['is_public' => 1, 'is_public_date' => Carbon::now()]);

                        $updateData[] = [
                            'id' => $row->id,
                            'is_public' => 1,
                            'is_public_date' => Carbon::now()
                        ];

                    } else {

                        if ($subIDError != $courseNO) {

                            $strerror[] = $booking_subject . " | " . $is_date . " |" . $row->booking_time_start . " - " . $row->booking_time_finish;
                        }
                        $subIDError = $courseNO;
                        //$strerror[] = $booking_subject . " | " . $is_date . " |" . $row->booking_time_start . " - " . $row->booking_time_finish;
                    }
                }
            }
            //booking_rooms::insert($setDataBooking);
            // แบ่งข้อมูลเป็นชุดๆ ละ 100 รายการแล้วส่งเข้า Queue

            collect($setDataBooking)->chunk(50)->each(function ($chunk) {
                dispatch(new ProcessBooking($chunk->toArray()));
            });
            if (!empty($updateData)) {

                collect($updateData)->chunk(50)->each(function ($chunk) {
                    dispatch(new UpdateRoomSchedule($chunk->toArray()));
                });

            }
            session()->regenerate();
        }
        // $deletedRows =  DB::table('room_schedules')              
        //->where('straff_account', $Byuser)
        //->delete();
        session()->put('errorImport', $strerror);
        if ($request->pages == "major") {
            //return redirect()->to('/major/schedules/views/'.$sessionId)->with('do', 'success');
            return view('admin.employee.importconfirm')->with([
                'strerror' => $strerror
            ]);
        } else {
            return view('admin.schedule.importconfirm')->with([
                'strerror' => $strerror
            ]);
        }
    }

    // ฟังก์ชันแปลงวันที่พุทธศักราชเป็นคริสต์ศักราช
    function convertThaiDateToGregorian($thai_date)
    {
        $date_parts = explode('/', $thai_date);
        $date_parts[2] -= 543; // แปลงเป็นปีคริสต์ศักราช
        return implode('/', $date_parts);
    }

    function getDatebyday($startDate, $endDate, $days)
    {
        // สร้าง DateTime objects สำหรับวันที่เริ่มต้นและสิ้นสุด
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $days = 2;

        // อาร์เรย์เพื่อเก็บผลลัพธ์
        $result = [];

        // Loop จนกระทั่งถึงวันที่สิ้นสุด
        while ($start <= $end) {
            // ตรวจสอบว่าวันนี้เป็นวันอังคารหรือศุกร์
            if ($start->format('N') == 2) {
                $result[] = $start->format('Y-m-d');
            } elseif ($start->format('N') == 5) {
                $result[] = $start->format('Y-m-d');
            }
            // เพิ่มวันที่ทีละหนึ่งวัน
            $start->modify('+1 day');
        }

        return $result;
    }


    function getListDay($days)
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
        $class = new HelperService();
        // วันที่ ที่กำหนดจาก Admin 
        $latestDateSchedule = $class->getfinalBookingDate();
        $is_duplicate = 0;
        $result = "";
        $is_error = "";
        $errorRoom = 0;
        $is_error_detail = "";
        //ตรวจสอบรหัส ID ที่จะแก้ไขก่อน 

        // $p_schedule_startdate = (isset($request->schedule_startdate)) ? $request->schedule_startdate : "0000-00-00";
        // $p_schedule_enddate = (isset($request->schedule_enddate)) ? $request->schedule_enddate : "0000-00-00";
        $p_schedule_starttime = (isset($request->booking_time_start)) ? $request->booking_time_start : "00:00:00";
        $p_schedule_endtime = (isset($request->booking_time_finish)) ? $request->booking_time_finish : "00:00:00";
        $p_schedule_repeatday = (isset($request->schedule_repeatday)) ? $request->schedule_repeatday : "";

        $errorRoom = Rooms::find($request->roomID) ? 0 : 1;

        if ($errorRoom) {
            $is_error = "ชื่อห้องไม่ถูกต้อง";
            $is_error_detail = "ชื่อห้องที่ท่านระบุไม่ถูกต้อง โปรดทำการตรวจสอบข้อมูลของท่านอีกครั้ง";
        }

        $setData = [
            'courseNO' => $request->courseNO,
            'courseTitle' => $request->courseTitle,
            'courseSec' => $request->courseSec,
            'Stdamount' => (int) $request->Stdamount,
            'booking_time_start' => $p_schedule_starttime,
            'booking_time_finish' => $p_schedule_endtime,
            'roomID' => $request->roomID,
            'lecturer' => $request->lecturer,
            'description' => $request->description,
            'staffupdated' => Carbon::now(),
            'straff_account' => $request->adminAccount,
            'schedule_startdate' => $latestDateSchedule->start_date,
            'schedule_enddate' => $latestDateSchedule->end_date,
            'schedule_repeatday' => $p_schedule_repeatday,
            'courseofyear' => $request->courseofyear,
            'terms' => $request->terms,
            'is_public' => 0,
            'is_error' => $is_error,
            'is_error_room' => $errorRoom,
            'is_error_detail' => $is_error_detail
        ];

        $result = roomSchedule::find($request->id);
        if ($result) {

            $sid = $result->is_group_session;
            $roomID = $result->roomID;
            $courseofyear = $result->courseofyear;
            $terms = $result->terms;
            $courseNO = $result->courseNO;
            $courseSec = $result->courseSec;

            if ($result->is_public) {
                // ลบข้อมูลใยคารางสอน 
                DB::table('booking_rooms')
                    ->where('import_sid', $sid)
                    ->where('roomID', $roomID)
                    ->where('courseNo', $courseNO)
                    ->where('booking_subject_sec', $courseSec)
                    ->delete();
            }

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
        $class = new HelperService();
        // วันที่ ที่กำหนดจาก Admin 
        $latestDateSchedule = $class->getfinalBookingDate();

        $p_schedule_startdate = (isset($latestDateSchedule->start_date)) ? $latestDateSchedule->start_date : "0000-00-00";
        $p_schedule_enddate = (isset($latestDateSchedule->end_date)) ? $latestDateSchedule->end_date : "0000-00-00";

        $p_schedule_starttime = (isset($request->booking_time_start)) ? $request->booking_time_start : "00:00:00";
        $p_schedule_endtime = (isset($request->booking_time_finish)) ? $request->booking_time_finish : "00:00:00";
        $p_schedule_repeatday = (isset($request->schedule_repeatday)) ? $request->schedule_repeatday : "";

        $setDataBooking = [
            'courseNO' => $request->courseNO,
            'courseTitle' => $request->courseTitle,
            'courseSec' => $request->courseSec,
            'Stdamount' => (int) $request->Stdamount,
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
            'terms' => $request->terms,
            'is_group_session' => $request->sesionId
        ];

        $success = roomSchedule::create($setDataBooking);
        if ($success) {
            return response()->json([
                'status' => 200,
                'msg' => $setDataBooking,
                'sessionId' => $request->sesionId
            ]);
        } else {
            return response()->json([
                'alert' => compact($success)
            ]);
        }
    }

    //  แสดงหน้าราวการ import 
    public function listimport(Request $request)
    {

        $sesionId = request()->session()->getId();
        //ข้อมูลห้อง ทั้งหมด join
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->where('roomTypeId', '<>', '1')
            ->where('is_open', '1')
            ->get();


        $getliatday = DB::table('listdays')
            ->select('dayTitle', 'dayList')
            ->get();

        $nowYear = (date('Y')) + 543;
        $Byuser = $request->session()->get('cmuitaccount');

        $sql = " SELECT 
        COUNT(courseNO) as countCourse,
        sum(is_duplicate) as countError,
        sum(is_error_room) as countErrorRoom,
        sum(is_public) as countPublic,
        room_schedules.*,department.dep_title,rooms.roomFullName           
        FROM room_schedules
        INNER JOIN users ON room_schedules.straff_account = users.email
        INNER JOIN department ON users.dep_id = department.dep_id
        LEFT JOIN rooms ON room_schedules.roomID = rooms.id       
        WHERE room_schedules.straff_account = '{$Byuser}'
        GROUP BY room_schedules.is_group_session        
        ";

        $getBookingList = DB::select(DB::raw($sql));

        /*$getBookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
            ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')         
            ->where('room_schedules.straff_account', $Byusre)
            ->groupby   ('is_group_session')
            ->get();*/

        return view('admin.schedule.listimports')->with([
            'nowYear' => $nowYear,
            'getBookingList' => $getBookingList,
            'getListRoom' => $getListRoom,
            'listDays' => $getliatday,
            'sesionId' => $sesionId
        ]);
    }

    public function  configroom(Request $request){

   
        $dataConfig = DB::table('jop_booking')->first();

        //ประเภทห้อง 
             $roomType = DB::table('room_type')
             ->select('id', 'roomtypeName')         
             ->get();
        
        return view('admin.schedule.confixroom')->with([
            'roomType' => $roomType,
            'dataConfig' => $dataConfig
        ]);
    }

    public function updateConfigRoom(Request $request)
    {
        $class = new HelperService();
        $chkroomtype =  $class->convertArrayToComma($request->chkroom);   

        $setData = [
            'chkroom' => $chkroomtype,
            'datestart' => $request->datestart,
            'endstart' => $request->endstart
        ];

        $result = jop_booking::find($request->id);
        if($result ) {
          $updated =   $result->update($setData);       
        }
      /* if ($updated) {
            return response()->json([
                'status' => 200,
                'msg' => 'บันทึกข้อมูลเรียบร้อย'
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'msg' => 'ไม่สามารถบันทึกข้อมูลได้'
            ]);
        } */

        //ประเภทห้อง 
        $roomType = DB::table('room_type')->select('id','roomtypeName')->get();
        $dataConfig = DB::table('jop_booking')->first();    
           
        return view('admin.schedule.confixroom')->with([
            'roomType' => $roomType,
            'dataConfig' => $dataConfig,
            'updated'=> true
        ]);
        
    }





}
