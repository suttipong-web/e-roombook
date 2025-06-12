<?php

namespace App\Imports;

use App\class\HelperService;
use App\Models\roomSchedule;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Session;
class ScheduleImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $start_date = "";
        $end_date = "";
        $is_error_detail ="";
        $class = new HelperService();
        if (!empty($row['courseno'])) {

           //  หาวันที่เริ่มและสิ้นสุดในการลงตารางเรียน 
           $latestTerm = $class->getfinalBookingDate();
           $start_date = $latestTerm->start_date;
           $end_date = $latestTerm->end_date;
           $start_time ="";
           $end_time ="";
            $roomId =0;
            $is_duplicate = 0;
            $is_error = 0;
            $iserror = "";
            // ห่า User  Upload 
            $cmuitaccount = Session::get('cmuitaccount');            
            $sessionId = session()->getId();           

            //ตรวจสอบหาอ ID ห้อง
           if(!empty($row["roomno"])){
              $sql=" SELECT rooms.id as roomID FROM rooms WHERE 
              (rooms.roomTitle='".$row["roomno"]."' ) LIMIT 1";
              $getRoomID = DB::select(DB::raw($sql));
              if($getRoomID) {
                $roomId = $getRoomID[0]->roomID;
              }else {
                $is_error= 1;
                $iserror ="ชื่อห้องไม่ถูกต้อง";
                $is_error_detail = "ชื่อห้องที่ท่านระบุไม่ถูกต้อง โปรดทำการตรวจสอบข้อมูลของท่านอีกครั้ง";
              }
            }

        // convert เวลาจาก Excel 0800 ให้เป็น 08:00    
        $start_time = $class->convertTimeFormat($row["time_start"]);
        $end_time = $class->convertTimeFormat($row["time_finish"]);


      //  'booking_time_start' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($start_time)),
      //  'booking_time_finish' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($end_time)),


        return new roomSchedule([
                    'courseNO' => $row["courseno"],
                    'courseTitle' => $row["coursetitle"],
                    'courseSec' => $row["sec"],
                    'Stdamount' => $row["number_of_student"],
                    'lecturer' => $row["lecturer"],
                    'roomNo' => $row["roomno"],
                    'schedule_startdate' =>$start_date,
                    'schedule_enddate' => $end_date,
                    'booking_time_start' =>$start_time,
                    'booking_time_finish' => $end_time,
                    'terms' => $row["terms"],
                    'schedule_repeatday' => $row["days"],
                    'courseofyear' => $row["courseofyear"],
                    'description' => $row["description"],
                    'straff_account' => $cmuitaccount,
                    'roomID'=>$roomId,
                    'is_import_excel'=>1,
                    'is_duplicate'=>0,
                    'is_group_session'=>$sessionId,
                    'is_error'=> $iserror,
                    'is_error_room'=> $is_error,
                    'is_error_detail'=> $is_error_detail
            ]);
        }
    }
}
