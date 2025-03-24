<?php

namespace App\Http\Controllers\major;

use App\class\HelperService;
use App\Http\Controllers\Controller;
use App\Models\Listday;
use App\Imports\ScheduleImport;
use App\Models\Rooms;
use App\Models\roomSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Excel;
use Session;

class majorController extends Controller

{
    public function __construct()
    {
        $this->middleware('checkusertype:major');
    }
    //
    public  function index(Request $request){        
        return view('admin.employee.index')->with([
                'title' => 'Dashboard Major' 
            ]);
    }
    
    //  แสดงหน้าราวการ import 
    public function listimport(Request $request){
        

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

       $sql= " SELECT 
        COUNT(courseNO) as countCourse,
        sum(is_duplicate) as countError,
        sum(is_public) as countPublic,
        room_schedules.*,department.dep_title,rooms.roomFullName           
        FROM room_schedules
        INNER JOIN users ON room_schedules.straff_account = users.email
        INNER JOIN department ON users.dep_id = department.dep_id
        LEFT JOIN rooms ON room_schedules.roomID = rooms.id       
        WHERE room_schedules.straff_account = '{$Byuser}'
        GROUP BY room_schedules.is_group_session        
        " ;
        $getBookingList = DB::select(DB::raw($sql));

        /*$getBookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
            ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')         
            ->where('room_schedules.straff_account', $Byusre)
            ->groupby   ('is_group_session')
            ->get();*/

        return view('admin.employee.listimport')->with([
            'nowYear' => $nowYear,
            'getBookingList' => $getBookingList ,
            'getListRoom'=>$getListRoom,
            'listDays'=>$getliatday
        ]);

    }



    public function schedules(Request $request) {
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
        $BookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
            ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')            
            ->where('room_schedules.straff_account', $Byuser)
            ->where('room_schedules.is_group_session', $sesid)      
            ->where('room_schedules.is_public',0)               
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

            //ตรวจสอบหาวัน /เวลานี้ว่ามีรายการซื้อไหม 
            $sql = " SELECT * FROM `room_schedules` WHERE
            room_schedules.roomID ='" . $rows->roomID . "'  AND
            DATE(room_schedules.schedule_startdate) >=  DATE('" . $rows->schedule_startdate . "') AND 
            DATE(room_schedules.schedule_enddate) <= DATE('" . $rows->schedule_enddate . "')  AND   
            room_schedules.schedule_repeatday = '" . $rows->schedule_repeatday . "' AND 
            ( room_schedules.is_public =1 )                    
                            
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
                            ->where('id', $rows->id)
                            ->update([
                                'is_duplicate' => 1,
								'is_error' => 'ไม่สามารถลงเวลาได้'
                            ]);
                    }
                }
            }


            //ตรวจสอบในตารางการจองหลัก 
              // ตรวจสอบในตารางจริง
              
              $numofday  =  $class->getListNumOfDay($rows->schedule_repeatday);
              // echo "<br/>".$rows->schedule_repeatday;
                $loopdate  =$class->getDateofday($rows->schedule_startdate,$rows->schedule_enddate,$numofday);
             // echo print_r($loopdate);                                            
                $error =1 ;            
               foreach ($loopdate as  $is_date) {                     
                   //ตรวจสอบว่าจองเวลานี้ได้ไหม         
                   $ChkTimeBookig = DB::table('booking_rooms')
                       ->select('booking_time_start', 'booking_time_finish')
                       ->where('booking_rooms.roomID', $rows->roomID  )
                       ->where('booking_rooms.booking_status',1)
                       ->where('booking_rooms.schedule_startdate', '>=',$is_date)
                       ->where('booking_rooms.schedule_enddate', '<=', $is_date)
                       ->get();                                
                   // ยืนยันการจอง
                   $is_confirm = 1; $text ="";
                   
                   foreach ($ChkTimeBookig as $row_chk) {
                       
                       $rowchkStart = str_replace(':', '', substr($row_chk->booking_time_start, 0, 5)); 
                       $rowchkEnd = str_replace(':', '', substr($row_chk->booking_time_finish, 0, 5)); 
                      // echo "<br/>".$rows->booking_time_start;
                       if (
                           ($rows->booking_time_start >=  $rowchkStart  && $rows->booking_time_start<  $rowchkEnd)
                           ||
                           ( $rows->booking_time_finish > $rowchkStart  &&  $rows->booking_time_finish <=  $rowchkEnd)
                           ||
                           ($rows->booking_time_start <  $rowchkStart &&  $rows->booking_time_finish >  $rowchkEnd)
                       ) {                                      
                           $error =0;                                   
                       } 
                   }
               }
               if(!$error) {
                      //เวลาซ้ำ    
                           $result = DB::table('room_schedules')                                     
                               ->where('id', $rows->id)
                               ->update([
                                   'is_duplicate' => 1,
                                   'is_error' => 'ไม่สามารถลงตารางได้'
                               ]);
                }

        }
        //-- END FOR --

        $getBookingList = roomSchedule::leftJoin('rooms', 'rooms.id', '=', 'room_schedules.roomID')
        ->select('room_schedules.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
        ->where('room_schedules.straff_account', $Byuser)
        ->where('room_schedules.is_group_session', $sesid)           
        ->orderBy('room_schedules.is_duplicate', 'DESC') 
        ->get();

        return view('admin.employee.schedule')->with([
            'getBookingList' => $getBookingList,
            'getListRoom' => $getListRoom,
            'nowYear' => $nowYear,
            'listDays' => $getliatday,
            'step'=>$request->step ,
            'sesionId'=> $sesid
        ]);                
    }

    public function views(Request $request) {
          return view('admin.employee.viewSchedule')->with([
            "TitlePage" => "แสดงรายการตารางเรียนของท่าน"
        ]);
    }

    public function fetchall(Request $request)
    {
        $class = new HelperService();
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
            SELECT room_schedules.roomID , 
            rooms.roomFullName,rooms.roomTitle ,room_schedules.courseofyear,room_schedules.terms
            FROM room_schedules
            INNER JOIN rooms ON room_schedules.roomID = rooms.id
            WHERE (room_schedules.straff_account = '{$Byuser}')  
            AND  (room_schedules.is_public =1)  ";        
        
        $sql .= " GROUP BY room_schedules.roomID   ORDER BY  room_schedules.roomID  ASC ";
        $getRoom = DB::select(DB::raw($sql));
       //echo $sql."<br/>";
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
                $sc_endtTime = date("Y-m-d 21:00:00");  // กำหนดเวลาสื้นสุด เปลี่ยนเฉพาะเลขเวลา
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
                    if (isset($uts) && $uts != "" && $uts !=0) { // เมื่อมีการเปลี่ยนสัปดาห์
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
                        AND  booking_rooms.is_import_excel =1
                        AND  booking_rooms.booker_cmuaccount= '{$Byuser}'
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
                                            "start_date"=>$row['start_date'],
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

        
                    $linkPrint = '/room/print/'.  $tableRoom->roomID.'/'. (int)$uts.'/'. $tableRoom->roomTitle ;
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
                                      <a class="btn btn-danger btn-sm btnPrint- ml-2" href='.$linkPrint.'  target="_blank"><i class="bi bi-printer"></i></a>      
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
        
                            $details = '<div> วันที่ '. $class->convertDateThaiNoTime($row_day['start_date'],1).' ช่วงเวลา : ' . Str::limit($row_day['start_time'],5,''). '-' .  Str::limit($row_day['end_time'],5,'') . ' <br/> ผู้ขอใช้ : ' . $row_day["sec"] .'   ('.$row_day["booking_phone"].' ) <br/> '.$row_day["depName"] .' </div>';
                            $outputBody .= '<div class="position-absolute text-center sc-detail-std" 
                                             detail="' . $details . '"
                                             htitle ="' . $row_day['title'] . '"
                                            style="width: ' . $sc_width . 'px;margin-right: 1px;margin-left:' . $sc_start_x . 'px;min-height: 60px;">
                                            <a href="#" title ="' . $row_day['title'] . '" >' . $subjectTitle . '</a></div>';
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

       //Import file Excel to Database with call 
    public function saveImportfile(Request $request)
    {
        $ses_id = session()->getId();
        $cmuitaccount = $request->session()->get('cmuitaccount');
        Excel::import(new ScheduleImport, $request->file('fileupload'));
        //return redirect()->back()->with('success', true);
        return redirect()->to('/major/schedules/views/'.$ses_id);
    }

    public function delete_import(Request $request)
    {       
       if(!empty($request->sid)){
        // ลบข้อมูลตาราง import
        DB::table('room_schedules')->where('is_group_session', $request->sid)->delete();
        // ลบข้อมูลตารางจองห้อง
        DB::table('booking_rooms')->where('import_sid', $request->sid)->delete();
       }
        
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
            // ลบข้อมูลในคารางสอน  room_schedules
           $t =  roomSchedule::destroy($id);
           return response()->json(['msg' => 'yes'.$id]);
            if($result->is_public)  {
                // ลบข้อมูลใยคารางสอน  booking_rooms                
                DB::table('booking_rooms')
                ->where('import_sid', $sid)
                ->where('roomID', $roomID)         
                ->where('courseNo', $courseNO)
                ->where('booking_subject_sec', $courseSec)
                ->delete();
            }        
           
        } else {
            return response()->json(['error' => 'ไม่พบข้อมูลid='.$id]);
        }
    }



}