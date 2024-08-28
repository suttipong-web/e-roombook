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
use App\Models\payments;
class BookingController extends Controller
{
    //
    public function index()
    {
        date_default_timezone_set('Asia/Bangkok');   
        $class = new HelperService();

        //ข้อมูลห้อง Select option
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')
             ->where('is_open', '1')
            ->get();
        
       //ประเภทห้อง 
        $roomType = DB::table('room_type')
        ->select('id', 'roomtypeName')
         ->limit(3)
        ->get();


        //ข้อมูลห้อง ทั้งหมด join
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->where('roomTypeId', '1')
            ->where('is_open', '1')
            ->get();

        $pageTitle ="ห้องประชุม";

        $searchDates  = date('d/m/Y');

        // Load index  view and  data room        
        return view('/bookingroom/index')->with(
            [
                'roomSlc' => $roomDataSlc,
                'getListRoom' => $getListRoom,
                'getroomType' => $roomType,
                'pageTitle'=>$pageTitle,
                'searchDates'=> $searchDates
                ]

        );
    }
    public function indexType(Request $request){
        $pageTitle ="";
        $searchDates  = date('d/m/Y');
        $typeId =  (!empty($request->typeId))? $request->typeId:'1';
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->where('roomTypeId',  $typeId)
            ->where('is_open', '1')
            ->get();
        
        //ข้อมูลห้อง Select option
        $roomDataSlc = Rooms::orderby('id', 'asc')
              ->select('id', 'roomFullName')
              ->where('roomTypeId',  $typeId)
               ->where('is_open', '1')
              ->get();
        if(!empty($getListRoom[0]->roomtypeName)){
         $pageTitle =$getListRoom[0]->roomtypeName;
        }
        //ประเภทห้อง 
          $roomType = DB::table('room_type')
          ->select('id', 'roomtypeName')
          ->limit(3)
          ->get();

         // Load index  view and  data room        
         return view('/bookingroom/index')->with(
            [
                'roomSlc' => $roomDataSlc,
                'getListRoom' => $getListRoom,
                'getroomType' => $roomType,
                'pageTitle'=> $pageTitle,
                 'searchDates'=> $searchDates
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
        $class = new HelperService();
        $search_date = $class->convertDateSqlInsert($request->search_date);
        
        $dateBooking = $request->search_date;
        $usertype = $request->usertype;
        // $datenow = date('d/m/Y');
        $datenow = date('Y-m-d');

        $DateScl = (!empty($search_date)) ? $search_date : $datenow;

        $roomID = (!empty($request->slcRoom)) ? $request->slcRoom : 1;

        //ข้อมูลห้อง Select option
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')
            ->get();

        //  $dateBooking = $request->search_date;

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
            /*->where('booking_rooms.booking_status', '<>', 0)*/
            ->where('booking_rooms.schedule_startdate', '>=', $DateScl)
            ->where('booking_rooms.schedule_enddate', '<=', $DateScl)
            ->orderBy('booking_time_start', 'ASC')
            ->get();


        $titleSearch = " รายการใช้  [ " . $roomData["roomFullName"] . " ]    ในวันที่   [ " . $dateBooking . " ] ";

             $RoomtitleSearch = $roomData["roomFullName"];
        $DateTitleSearch  =$dateBooking ;
        // Load index  view and  data room        
        return view('/bookingroom/search')->with(
            [
                 'RoomtitleSearch' => $RoomtitleSearch,
                'DateTitleSearch'=> $DateTitleSearch,
                'getBookingList' => $searhResult,
                'roomSlc' => $roomDataSlc,
                'searchRoomID' => $roomID,
                'searchDates' => $dateBooking,         
                'imgRoom' => $roomData->thumbnail,
                'usertype' => $usertype
            ]
        );
    }

   public function setform(Request $request)
    {
        $roomID = $request->roomID;
        
        $roomData = Rooms::find($roomID);
       
        $RoomtitleSearch = $roomData["roomFullName"];
        $dateNow = date('Y-m-d');
        $usertype = $request->usertype;
        $tempdateBooking =$request->datesearch;

        $formattedDate = str_replace("-", "/", $tempdateBooking);
        $dateBooking = implode("/", array_reverse(explode("/", $formattedDate)));

        //Select option ข้อมูลห้อง 
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')           
            ->where('roomTypeId',$roomData->roomTypeId)
            ->get();

        return view('/bookingroom/form')->with(
            [
                'RoomtitleSearch' => $RoomtitleSearch,  
                'roomSlc' => $roomDataSlc,
                'searchRoomID' => $roomID,
                'searchDates' => $dateBooking,               
                'usertype' => $usertype
            ]
        );


    }

    public function check(Request $request)
    {

        $roomID = $request->roomID;
        $roomData = Rooms::find($roomID);
        $dateNow = date('Y-m-d');
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
            /*->where('booking_rooms.booking_status', '<>', 0)*/
            ->where('booking_rooms.schedule_startdate', '>=', $dateNow)
            ->where('booking_rooms.schedule_enddate', '<=', $dateNow)
            ->orderBy('booking_time_start', 'ASC')
            ->get();

        $RoomtitleSearch = $roomData["roomFullName"];
        $DateTitleSearch  = $dateNow ;
        // Load index  view and  data room        

        //Select option ข้อมูลห้อง 
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')           
            ->where('roomTypeId',$roomData->roomTypeId)
            ->get();

        return view('/bookingroom/search')->with(
            [
                'RoomtitleSearch' => $RoomtitleSearch,
                'DateTitleSearch'=> $DateTitleSearch,
                'getBookingList' => $searhResult,
                'roomSlc' => $roomDataSlc,
                'searchRoomID' => $roomID,
                'searchDates' => $dateBooking,               
                'usertype' => $usertype
            ]
        );
    }


    public function insertBooking(Request $request)
    {
        $class = new HelperService();

        $error = false;
        $fileName = '';
        $is_confirm = 0;
        //วันที่ 
        $schedule_startdate = $class->convertDateSqlInsert($request->schedule_startdate);
        $schedule_enddate = $class->convertDateSqlInsert($request->schedule_enddate);

        // ตรวจสอบวันที่                 
        $startDate = Carbon::parse($schedule_startdate); // The start date
        $endDate = Carbon::parse($schedule_enddate); // The end date        
        if ($startDate > $endDate) {
            return response()->json([
                'status' => 421,
                'errortext' => 'ระบบไม่สามารถประมาลผลได้ กรุณาตรวจสอบวันเวลา และข้อมูลของท่านอีกครั้ง..'
            ]);
        }
        // ตรวจสอบวันที่เวลา 
        // เวลาเริ่ม 
        $bkstart = $request->booking_time_start;
        // เวลาสิ้สสุด
        $bkfinish = $request->booking_time_finish;

        $startTime = Carbon::parse($bkstart);
        $endTime = Carbon::parse($bkfinish);

        if ($startTime > $endTime) {
            return response()->json([
                'status' => 422,
                'errortext' => 'ระบบไม่สามารถประมาลผลได้ กรุณาตรวจสอบวันเวลา และข้อมูลของท่านอีกครั้ง..'
            ]);
        }

        //ตรวจสอบบุคคลภายนอก
        if ($request->booking_type == "general") {
            // Handle the file upload
            if ($request->hasFile('pdf')) {
                $file = $request->file('pdf');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
               // $file->storeAs('public/upload', $fileName);

              //  $request->file('pdf')->storeAs('upload', $fileName , 'public');
                $file->move(public_path('upload'), $fileName);




                // Return a response
                $error = true;
            } else {
                return response()->json([
                    'status' => 209,
                    'errortext' => 'บุคคลภายนอกต้องทำการแนบไฟล์ เพื่อขอใช้สถานที่และต้องเป็นเอกสาร ชนิดไฟล์ .pdf เท่านั้น'
                ]);
            }
            // Validate the request
            $is_confirm = 0;
        }

        //ตรวจสอบว่าจองเวลานี้ได้ไหม 

        $ChkTimeBookig = DB::table('booking_rooms')
            ->select('booking_time_start', 'booking_time_finish')
            ->where('booking_rooms.roomID', $request->roomID)
            ->where('booking_rooms.booking_status', '<>', 2)
            ->where('booking_rooms.schedule_startdate', '>=', $schedule_startdate)
            ->where('booking_rooms.schedule_enddate', '<=', $schedule_enddate)
            ->get();

        // ยืนยันการจอง
        $is_confirm = true;
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
                $error = 0;
                $is_confirm = 0;
            } else {
                $is_confirm = 3;
            }
        }
      //  $is_confirm =3;
        if ($error) {
            $bookingToken = md5(time());
            $filenames = "";
            $no = time();
            $result = "";

            //บุคคลภายใน รอการอนุมัติ
            if (!empty($request->booker_cmuaccount)) {
                $is_confirm = 3;
            }

            if ($request->booking_type == "general") {
                $is_confirm = 0;
            }

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
                'booking_at' => Carbon::now(),
                'booking_fileurl' => $fileName,
                'booking_status' => $is_confirm,
                'booking_code_cancel'=>$request->booking_code_cancel
            ];
                      
        $result = booking_rooms::create($setDataBooking);      
        if ($result) {
            $lastInsertedId = $result->id;
            // SET  Data Payment     
                $setDataPayment = [
                'customerName' => $request->fullname_receipt,
                'customerEmail' => $request->email_receipt,
                'customerPhone' => '',
                'customerTaxid' => $request->taxpayer_receipt,
                'customerAddress' => $request->address_receipt,
                'totalAmount' => '0',
                'payment_status' => '0',
                'bookingID' => $lastInsertedId
            ];
            // insert table Payments 
            $insert = payments::create($setDataPayment);           
        } 




             $msgreturn ="";

            if ($result) {
                $roomData = Rooms::find($request->roomID);
                // ส่ง LINE                  
                $bookingRoom = $roomData->roomFullName;
                $ิbooker = $request->booking_booker;
                $msgLine = "มีรายการใหม่!%0A";
                $msgLine .= "จากคุณ" . $ิbooker . "%0A";
                $msgLine .= "ห้องที่ขอใช้:" . $bookingRoom . "%0A";
                $msgLine .= "ตรวจสอบข้อมูลได้ที่ E-roombook";

                // get Token  Admin 
                $tokenUSer = $class->getlineTokenAdminRoom($request->roomID, 2);
                if ($tokenUSer) {
                    // lop หากมี Admin หลายคน                
                    foreach ($tokenUSer as $admins) {
                        $class->sendMessageTOline($admins->lineToken, $msgLine);
                    }
                }

                if ($request->booking_type == "general") {
                    $msgreturn ="ท่านทำรายการสำเร็จ ทางทีมงานจะรีบดำเนินการตรวจสอบรายละเอียด และแจ้งผลให้ท่านทราบโดยด่วน ";
                }else {
                    $msgreturn ="ทำรายการจองสำเร็จ";
                }
                return response()->json([
                    'status' => 200,
                    'searchRoomID' => $request->roomID,
                    'searchDates' => $request->schedule_startdate,
                    'msgreturn'=>$msgreturn
                ]);
            }

            return response()->json([
                'status' => 208,
                'searchRoomID' => $request->roomID,
                'searchDates' => $request->schedule_startdate,
                'error' => $result
            ]);
        }
    }
    public function cancelBooking(Request $request){    
        $bookingID = $request->bookingId;
        $booking_code_cancel = $request->booking_code_cancel;
        $result = booking_rooms::find($bookingID);   
        if($result) {        
             $deletedRows =  DB::table('booking_rooms')
                ->where('id', $bookingID)
                ->where('booking_code_cancel', $booking_code_cancel)
                ->delete();
            if ($deletedRows > 0) {
                // ลบสำเร็จ
             return response()->json([
                    'status' => 200
              ]);
            }
        }
        
        return "No data found to delete."; 
     }   
     
}