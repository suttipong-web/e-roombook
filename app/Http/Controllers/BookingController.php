<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\booking_rooms;
use App\Models\Rooms;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

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
            ->get();

        //ประเภทห้อง 
        $roomType  = DB::table('room_type')
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
    public  function filter(Request $request)
    {
        //ข้อมูลห้อง ตามประเภท
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->where('roomTypeId', $request->typeID)
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

    public  function search(Request $request)
    {
        //ข้อมูลห้อง Select option
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')
            ->get();

        // 25/06/2024
        $dateBooking = $request->search_date;
        $roomID = $request->slcRoom;
        $roomData = Rooms::find($roomID);

        if (!empty($roomData->thumbnail)) {
            $img = '/storage/images/' . $roomData->thumbnail;
        } else {
            $img = '/storage/images/noimage.png';
        }

        //  $matchThese = ['booking_rooms.roomID' => $roomID, 'booking_rooms.booking_time_start' =>$dateBooking];
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
                'imgRoom'   => $roomData->thumbnail
            ]
        );
    }

    public  function insertBooking(Request $request)
    {
        //ตรวจสอบว่าจองเวลานี้ได้ไหม 
        $ChkTimeBookig  = DB::table('booking_rooms')
            ->select('booking_time_start', 'booking_time_finish')
            ->where('booking_rooms.roomID', $request->roomID)
            ->where('booking_rooms.booking_date', $request->dateStart)
            ->get();

        // เวลาเริ่ม 
        $bkstart =  $request->booking_time_start;
        // เวลาสิ้สสุด
        $bkfinish =  $request->booking_time_finish;
        $error = true;
        foreach ($ChkTimeBookig as $row_chk) {
            if (
                ($bkstart >= $row_chk->booking_time_start && $bkstart < $row_chk->booking_time_finish)
                ||
                ($bkfinish > $row_chk->booking_time_start && $bkfinish <= $row_chk->booking_time_finish)
                ||
                ($bkstart <  $row_chk->booking_time_start && $bkfinish > $row_chk->booking_time_finish)
            ) {
                return response()->json([
                    'status' => 208,
                    'text' => 'มีรายการจองของวันนี้แล้ว'
                ]);
                $error = false;
            }
        }

        if ($error) {
            $bookingToken  = md5(time());
            //checkbox
            $zoom =  ($request->booking_zoom == 1) ? true : false;
            $computer = ($request->booking_computer == 1) ? true : false;
            $booking_lcd  = ($request->booking_lcd == 1) ? true : false;
            $booking_food  =  ($request->booking_food == 1) ? true : false;
            $booking_camera  = ($request->booking_camera == 1) ? true : false;

            $no = time();
            $setDataBooking = [
                'booking_no' => $no,
                'bookingToken' => $bookingToken,
                'roomID' => $request->roomID,
                'booking_date' => $request->dateStart,
                'booking_time_start' => $request->booking_time_start,
                'booking_time_finish' => $request->booking_time_finish,
                'booking_subject' => $request->booking_subject,
                'booking_booker' => $request->booking_booker,
                'booking_ofPeople' => $request->booking_ofPeople,
                'booking_department' => $request->booking_department,
                'booking_computer' => $computer,
                'booking_zoom' => $zoom,
                'booking_lcd' => $booking_lcd,
                'booking_food' => $booking_food,
                'booking_camera' => $booking_camera,
                'booker_cmuaccount' => $request->booker_cmuaccount,
                'description' => $request->description,
                'booking_cancel' => $request->booking_cancel,
                'booking_at' => Carbon::now()
            ];
            // echo print_r($setDataBooking);
            booking_rooms::create($setDataBooking);
            return response()->json([
                'status' => 200,
                'searchRoomID' => $request->roomID,
                'searchDates' => $request->dateStart
            ]);
        }
    }
}
