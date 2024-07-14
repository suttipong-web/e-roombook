<?php

namespace App\Imports;

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
        if (!empty($row['courseno'])) {
            $roomId =0;

            // ห่า User  Upload 
            $cmuitaccount = Session::get('cmuitaccount');

            //ตรวจสอบหาอ ID ห้อง
           if(!empty($row["roomno"])){
              $sql=" SELECT rooms.id as roomID FROM rooms WHERE 
              (rooms.roomTitle='".$row["roomno"]."' OR   rooms.roomTitle like '%".$row["roomno"]."%' ) LIMIT 1";
              $getRoomID = DB::select(DB::raw($sql));
              $roomId = $getRoomID[0]->roomID;
            }
                   

            return new roomSchedule([
                    'courseNO' => $row["courseno"],
                    'courseTitle' => $row["coursetitle"],
                    'courseSec' => $row["sec"],
                    'Stdamount' => $row["number_of_student"],
                    'lecturer' => $row["lecturer"],
                    'roomNo' => $row["roomno"],
                    'schedule_startdate' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["startdate"])),
                    'schedule_enddate' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["enddate"])),
                    'booking_time_start' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["time_start"])),
                    'booking_time_finish' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["time_finish"])),
                    'terms' => $row["terms"],
                    'schedule_repeatday' => $row["days"],
                    'courseofyear' => $row["courseofyear"],
                    'description' => $row["description"],
                    'straff_account' => $cmuitaccount,
                    'roomID'=>$roomId,
                    'is_import_excel'=>1

            ]);
        }
    }
}
