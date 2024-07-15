<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\booking_rooms;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;
use App\class\HelperService;

class BookingController extends Controller
{
    //
    public function index()
    {
        //ข้อมูลห้อง Select option
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')
            ->get();

        //ข้อมูลห้อง ทั้งหมด join
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->where('roomTypeId', '1')
            ->where('is_open', '1')
            ->get();

        //ประเภทห้อง 
        $roomType = DB::table('room_type')
            ->select('id', 'roomtypeName')
            ->get();

        // Load index  view and  data room        
        return view('/bookingroom/index')->with(
            [
                'roomSlc' => $roomDataSlc,
                'getListRoom' => $getListRoom,
                'getroomType' => $roomType
            ]

        );
    }
    public function filter(Request $request)
    {
        //ข้อมูลห้อง ตามประเภท
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->where('roomTypeId', $request->typeID)
            ->where('is_open', '1')
            ->get();


        $output = '';
        foreach ($getListRoom as $rows) {
            if (!empty($rows->thumbnail)) {
                $img = '/storage/images/' . $rows->thumbnail;
            } else {
                $img = '/storage/images/noimage.png';
            }

            $output .= '    <div class="col">
                                <div class="card h-100">
                                    <img src="' . $img . ' " class="card-img-top"
                                        alt=" ' . $rows->roomFullName . ' ">
                                    <div class="card-body">
                                        <h6 class="card-title text-center">' . $rows->roomFullName . ' </h6>
                                        <div class="card-text">ประเภทห้อง :  ' . $rows->roomtypeName . ' </div>
                                        <div class="card-text">ขนาด/ความจุห้อง : ' . $rows->roomSize . '  ที่นั่ง</div>
                                        <p class="card-text">รายละเอียด : ' . $rows->roomDetail . '</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <button type="button" class="btn btn-outline-secondary">
                                            ตรวจสอบการจอง
                                        </button>
                                    </div>
                                </div>
                            </div> ';
            // return data by ajax
            echo $output;
        }
    }

    public function search(Request $request)
    {
        $datenow = date('d/m/Y');
        $roomDataSlc = (!empty($request->search_date)) ? $request->search_date : $datenow;
        $roomID = (!empty($request->slcRoom)) ? $request->slcRoom : 1;
        //ข้อมูลห้อง Select option
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')
            ->get();


        $dateBooking = $request->search_date;
        $roomID = $request->slcRoom;
        $roomData = Rooms::find($roomID);

        if (!empty($roomData->thumbnail)) {
            $img = '/storage/images/' . $roomData->thumbnail;
        } else {
            $img = '/storage/images/noimage.png';
        }

        // Query Booking room Table 
        $searhResult = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_rooms.roomID', $roomID)
            ->where('booking_rooms.booking_date', $dateBooking)
            ->get();

        $titleSearch = " รายการใช้  [ " . $roomData["roomFullName"] . " ]    ในวันที่   [ " . $dateBooking . " ] ";
        // Load index  view and  data room        
        return view('/bookingroom/search')->with(
            [
                'titleSearch' => $titleSearch,
                'getBookingList' => $searhResult,
                'roomSlc' => $roomDataSlc,
                'searchRoomID' => $roomID,
                'searchDates' => $dateBooking,
                'imgRoom' => $roomData->thumbnail
            ]
        );
    }

    public function check(Request $request)
    {
        $roomID = $request->roomID;
        $roomData = Rooms::find($roomID);
        $dateNow  = date('Y-m-d');
        $usertype = $request->usertype;
        // 25/06/2024
        $dateBooking = date('d/m/Y');

        if (!empty($roomData->thumbnail)) {
            $img = '/storage/images/' . $roomData->thumbnail;
        } else {
            $img = '/storage/images/noimage.png';
        }

        // Query Booking room Table 
        $searhResult = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_rooms.roomID', $roomID)
            ->where('booking_rooms.schedule_startdate', '>=', $dateNow)
            ->where('booking_rooms.schedule_enddate', '<=', $dateNow)
            ->get();

        $titleSearch = " รายการใช้  [ " . $roomData["roomFullName"] . " ]    ในวันที่   [ " . $dateNow . " ] ";
        // Load index  view and  data room        

        //Select option ข้อมูลห้อง 
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')
            ->get();

        return view('/bookingroom/search')->with(
            [
                'titleSearch' => $titleSearch,
                'getBookingList' => $searhResult,
                'roomSlc' => $roomDataSlc,
                'searchRoomID' => $roomID,
                'searchDates' => $dateBooking,
                'imgRoom' => $roomData->thumbnail, 
                'usertype'=> $usertype
            ]
        );
    }


    public function insertBooking(Request $request)
    {
        $class = new HelperService();
        //ตรวจสอบว่าจองเวลานี้ได้ไหม 
        $ChkTimeBookig = DB::table('booking_rooms')
            ->select('booking_time_start', 'booking_time_finish')
            ->where('booking_rooms.roomID', $request->roomID)
            ->where('booking_rooms.booking_date', $request->dateStart)
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
        if ($error) {
            $bookingToken = md5(time());
            $no = time();
            $result = "";
            //15/07/2024
            $schedule_startdate =  $class->convertDateSqlInsert($request->schedule_startdate);
            $schedule_enddate = $class->convertDateSqlInsert($request->schedule_enddate);

            $setDataBooking = [
                'booking_no' => $no,
                'bookingToken' => $bookingToken,
                'roomID' => $request->roomID,
                'booking_date' => $request->schedule_startdate,
                'booking_time_start' => $request->booking_time_start,
                'booking_time_finish' => $request->booking_time_finish,
                'booking_subject' => $request->booking_subject,
                'booking_booker' => $request->booking_booker,
                'booking_ofPeople' => $request->booking_ofPeople,
                'booking_department' => $request->booking_department,
                'schedule_startdate' => $schedule_startdate,
                'schedule_enddate' => $schedule_enddate,
                'booking_phone' => $request->booking_phone,
                'booking_email' => $request->booking_email,
                'booker_cmuaccount' => $request->booker_cmuaccount,
                'description' => $request->description,
                'booking_type' => $request->booking_type,                
                'booking_at' => Carbon::now()
            ];
            echo print_r($setDataBooking);
            exit;
            // $result = booking_rooms::create($setDataBooking);
            if ($result) {
                return response()->json([
                    'status' => 200,
                    'searchRoomID' => $request->roomID,
                    'searchDates' => $request->schedule_startdate
                ]);
            }
        }
    }
}
