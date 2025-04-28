<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\class\HelperService;
use App\Models\booking_rooms;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ScheduleroomController extends Controller
{
    public function fetchScheduleByRoom(Request $request)
    {
        $class = new HelperService();
        $output = " ไม่พบรายการลงเวลาของท่าน ";
        $roomTypeId = "";
        // ส่วนของตัวแปรสำหรับกำหนด
        $dayTH = array("จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์", "อาทิตย์");
        $monthTH = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $monthTH_brev = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        $roomId = 0;

        $roomTitle = "";

        if ($request->getroomId) {
            $roomID = $request->getroomId;
            $dataroom = Rooms::find($roomID);
            $roomTitle = $dataroom->roomFullName;
            $roomTypeId = $dataroom->roomTypeId;
            $tableRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
                ->join('place', 'place.id', '=', 'rooms.placeId')
                ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
                ->get();

        }

        $roomIdDisplay = 0;

        ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
        $sc_startTime = date("Y-m-d 08:00:00");  // กำหนดเวลาเริ่มต้ม เปลี่ยนเฉพาะเลขเวลา
        $sc_endtTime = date("Y-m-d 22:00:00");  // กำหนดเวลาสื้นสุด เปลี่ยนเฉพาะเลขเวลา
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
        ///////////////// ส่วนของข้อมูล ที่ดึงจากฐานข้อมูล ////////////////////////
        $sql = " SELECT booking_rooms.*,rooms.roomFullName,rooms.roomTitle
                    FROM booking_rooms
                    INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                    WHERE booking_rooms.roomID = '{$roomID}' AND  booking_rooms.booking_status =1
                    
                         /* (booking_rooms.booking_status >=1)  AND */
                         AND (
                          (schedule_startdate  >= '" . $start_weekDay . "' AND schedule_startdate <  '" . $end_weekDay . "') OR
                          ('" . $start_weekDay . "' > schedule_startdate  AND schedule_enddate <  '" . $end_weekDay . "'  AND schedule_enddate >= '" . $start_weekDay . "' )  OR
                          ('" . $start_weekDay . "' > schedule_startdate  AND '" . $end_weekDay . "'  < schedule_enddate  AND schedule_enddate >= '" . $start_weekDay . "' ) 
                         )
                    ORDER BY
                    booking_rooms.booking_date ASC
                    ";

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

                // $sec = ($roomTypeId==1) ? $row->booking_booker : $row->booking_Instructor;
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
                    "Instructor" => $row->booking_Instructor

                );
            }
        }
        // var_dump($data_schedule);
        //exit;
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

        $linkPrint = '/room/print/' . $roomID . '/' . (int) $uts . '/' . $roomTitle;
        $num_dayShow_in_schedule = $num_dayShow - 1;
        $output = '<div class="wrap_schedule_control mt-3">
                        <div class="d-flex  justify-content-start">';

        if (!$request->hindenBtnALL) {
            $output .= '            <div class="">
                               
                                    <button type="button" class="btn btn-secondary btn-sm btnUTS mr-2" valuts =' . $timestamp_prev . ' >< Prev </button>
                                    <button type="button" class="btn btn-secondary btn-sm btnUTS " valuts =' . $timestamp_next . ' >Next > </button>
                                    <button type="button" class="btn btn-primary btn-sm btnUTS ml-2" valuts ="" > Home </button> ';
            if ($request->hindenPrint) {
                $output .= '   <button type="button" class="btn btn-danger btn-sm btnPrint ml-2" > <i class="bi bi-printer"></i> </button> ';

            } else {
                $output .= '     <a class="btn btn-danger btn-sm btnPrint- ml-2" href=' . $linkPrint . '  target="_blank"><i class="bi bi-printer"></i></a> 
                                    
                                    ';
            }


        }
        if (!$request->hindenBtnBooking) {
            $output .= '       
                                   <button type="button"  class="btn btn-primary btn-sm ml-3" data-bs-toggle="modal"
                                   data-bs-target="#caseBooker">
                                      <i class="bi bi-calendar-week-fill"></i> ทำรายการขอใช้ห้อง 
                                 </button> ';
        }

        $output .= '                           
                                </div>
                            </div>
                        </div>            
                  <br>
                    <div class="wrap_schedule">
                            <div class="table-responsive ">
                                <table class="table table-bordered bg-light">
                                    <thead class="thead-light">
                                        <tr class="time_schedule ">
                                        <th class="p-0">
                                            <div class="day-head-label text-right text-end">
                                                เวลา
                                            </div>
                                            <div class="diagonal-cross"></div>
                                            <div class="time-head-label text-left text-start">
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
                                <tbody  class="bg-light"> ';
        $outputBody = "";
        // วนลูปแสดงจำนวนวันตามที่กำหนด
        for ($i_day = 0; $i_day < $num_dayShow; $i_day++) {
            $dayInSchedule_chk = date("Y-m-d", strtotime($start_weekDay . " +" . $i_day . " day"));
            $dayKeyChk = date("D", strtotime($start_weekDay . " +" . $i_day . " day"));
            //$dayInSchedule_show = date("d-m-Y", strtotime($start_weekDay . " +" . $i_day . " day"));
            $dayInSchedule_show = $class->thai_date_short(strtotime($start_weekDay . " +" . $i_day . " day"));
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
                                            <div class="bg-light text-center border-right" style="width:' . $hour_block_width . 'px;margin-right: 0px;">
                                                &nbsp;
                                            </div>';
            }
            $outputBody .= '' . $inRowDay . '</div>
                                </div>
                                <div class="position-absolute" style="z-index: 100;">';
            // $strLop = "";
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


                    $ownertitle = ($roomTypeId == 1) ? 'ผู้ขอใช้' : 'ผู้สอน';
                    if ($roomTypeId == 1) {
                        $classColorBG = "sc-detail";
                        $details = '<div> วันที่ ' . $class->convertDateThaiNoTime($row_day['start_date'], 1) . ' ช่วงเวลา : ' . Str::limit($row_day['start_time'], 5, '') . '-' . Str::limit($row_day['end_time'], 5, '') . ' <br/>  ผู้ขอใช้: ' . $row_day["sec"] . '   (' . $row_day["booking_phone"] . ' ) <br/> ' . $row_day["depName"] . ' </div>';
                    } else {
                        $classColorBG = "sc-detail-std";
                        $details = '<div> วันที่ ' . $class->convertDateThaiNoTime($row_day['start_date'], 1) . ' ช่วงเวลา : ' . Str::limit($row_day['start_time'], 5, '') . '-' . Str::limit($row_day['end_time'], 5, '') . ' <br/> ผู้สอน : ' . $row_day["sec"] . ' <br/> ' . $row_day["depName"] . ' </div>';
                    }


                    $outputBody .= '<div class="position-absolute text-center clickscDetail ' . $classColorBG . '" 
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


    public function fetchScheduleAll(Request $request)
    {
        $class = new HelperService();
        $output = " ไม่พบรายการลงเวลาของท่าน ";
        $searchDate=  $request->dateSearch;
        $roomTypeId = ($request->roomTypeId) ? $request->roomTypeId : 2;

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
        $sql = "
            SELECT rooms.roomFullName,rooms.roomTitle,rooms.roomTypeId,rooms.id AS roomID
            FROM rooms           
            WHERE  rooms.is_open =1 AND     roomTypeId = '{$roomTypeId}'
            ";

        $sql .= "  ORDER BY  roomID  ASC ";
        $getRoom = DB::select(DB::raw($sql));
 
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
                $now_day =$searchDate; // วันปัจจุบัน ให้แสดงตารางที่มีวันปัจจุบัน เมื่อแสดงครั้งแรก
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

 
                ///////////////// ส่วนของข้อมูล ที่ดึงจากฐานข้อมูล ////////////////////////
                $sql = " SELECT booking_rooms.*,rooms.roomFullName,rooms.roomTitle,rooms.roomToken
                        FROM booking_rooms
                        INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                        WHERE booking_rooms.roomID = '{$tableRoom->roomID}' 
                        AND  booking_rooms.booking_status =1                       
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
                    $output .= 'ตารางเรียนห้อง &nbsp<span class="badge badge-info"><h5>' . $tableRoom->roomFullName . '</h5> </span> &nbsp&nbspช่วงวันที่ ' . $class->thai_date_short(strtotime($start_weekDay)) . ' ถึง ' . $class->thai_date_short(strtotime($start_weekDay . $num_dayShow_in_schedule . ' day')) . '</div>';
                    $output .= '  <div class="col-auto text-right ml-auto">';
                    $slc = '<div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="sclcourseofyear' . $tableRoom->roomID . '"> ปีการศึกษา </label>
                                            </div>     
                                    </div> 
                                <div class="col-auto text-right my-2 p-2"> ';
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
                        $dayInSchedule_show = $class->thai_date_short(strtotime($start_weekDay . " +" . $i_day . " day"));
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

    }






}