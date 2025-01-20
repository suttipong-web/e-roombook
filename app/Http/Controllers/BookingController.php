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
              ->where('roomTypeId', '1')
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


    public function linksearch(Request $request){
     return redirect()->intended('/booking')->with('success', '');
        
    }


    public function indexType(Request $request){
           date_default_timezone_set('Asia/Bangkok');   
       

           

        $pageTitle ="";
        $searchDates  = date('d/m/Y');
        $typeId =  (!empty($request->typeId))? $request->typeId:'1';
          //ข้อมูลห้อง Select option
        $roomDataSlc = Rooms::orderby('id', 'asc')
              ->select('id', 'roomFullName')
              ->where('roomTypeId',  $typeId)
               ->where('is_open', '1')
              ->get();
        
        $getListRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
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
         date_default_timezone_set('Asia/Bangkok'); 

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
         date_default_timezone_set('Asia/Bangkok'); 
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
            ->where('roomTypeId', '1')
            ->where('is_open', '1')
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
                 $sql= "SELECT
                    booking_rooms.*,
                    rooms.roomFullName,
                    rooms.roomDetail,rooms.roomSize
                    FROM
                    booking_rooms
                    INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                    WHERE
                    booking_rooms.roomID = '{$roomID}' AND
                    (
                    booking_rooms.schedule_startdate = '{$DateScl}' OR
                    booking_rooms.schedule_enddate = '{$DateScl}'
                    )
                    ORDER BY
                    booking_rooms.booking_time_start ASC";
         $searhResult = DB::select(DB::raw($sql));
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


   public function listall(Request $request){
    $roomID =0;
    date_default_timezone_set('Asia/Bangkok'); 
    $class = new HelperService();
      $datenow = date('Y-m-d');
     $sql= "SELECT
                    booking_rooms.*,
                    rooms.roomFullName,
                    rooms.roomDetail,rooms.roomSize
                    FROM
                    booking_rooms
                    INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                    WHERE           
                    (
                    booking_rooms.schedule_startdate >= '{$datenow}' 
                    )
                    ORDER BY
                    booking_rooms.booking_time_start ASC";
         $getBookingList = DB::select(DB::raw($sql));


     return view('/room/listAll')->with(
            [
                'bookingall' =>$getBookingList
            ]
        );

   } 

    public function listallByRoom(Request $request){
    $roomID =0;
     date_default_timezone_set('Asia/Bangkok'); 
      $class = new HelperService();
      
     return view('/booking/listall/0')->with(
            [

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
               $sql= "SELECT
                    booking_rooms.*,
                    rooms.roomFullName,
                    rooms.roomDetail,rooms.roomSize
                    FROM
                    booking_rooms
                    INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                    WHERE
                    booking_rooms.roomID = '{$roomID}' AND
                    (
                    booking_rooms.schedule_startdate = '{$dateNow}' OR
                    booking_rooms.schedule_enddate = '{$dateNow}'
                    )
                    
                    ORDER BY
                    booking_rooms.booking_time_start ASC";
         $searhResult = DB::select(DB::raw($sql));     



        $RoomtitleSearch = $roomData["roomFullName"];
        $DateTitleSearch  = $dateNow ;
        // Load index  view and  data room        


        $typeId =  (!empty($roomData->roomTypeId))? $request->typeId:'1';
          //ข้อมูลห้อง Select option

        //Select option ข้อมูลห้อง 
        $roomDataSlc = Rooms::orderby('id', 'asc')
            ->select('id', 'roomFullName')           
            ->where('roomTypeId',$roomData->roomTypeId)
            ->where('is_open', '1')
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
        $bkstart_ = $request->booking_time_start;
        // เวลาสิ้สสุด
        $bkfinish_ = $request->booking_time_finish;

        $bkstart  =  str_replace(':', '', substr($bkstart_, 0, 5));
        $bkfinish  =  str_replace(':', '', substr($bkfinish_, 0, 5));


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
             if (!$request->hasFile('pdf')) {
                  return response()->json([
                    'status' => 209,
                    'errortext' => 'บุคคลภายนอกต้องทำการแนบไฟล์ เพื่อขอใช้สถานที่และต้องเป็นเอกสาร ชนิดไฟล์ .pdf เท่านั้น'
                ]);
             }
       }
            // Handle the file upload
            if ($request->hasFile('pdf')) {
                $file = $request->file('pdf');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
               // $file->storeAs('public/upload', $fileName);
              //  $request->file('pdf')->storeAs('upload', $fileName , 'public');
                $file->move(public_path('upload'), $fileName);
               // Return a response
                $error = true;
            }
            
            /*else {
                return response()->json([
                    'status' => 209,
                    'errortext' => 'บุคคลภายนอกต้องทำการแนบไฟล์ เพื่อขอใช้สถานที่และต้องเป็นเอกสาร ชนิดไฟล์ .pdf เท่านั้น'
                ]);
            }*/
            // Validate the request
            $is_confirm = 0;
       // }

        //ตรวจสอบว่าจองเวลานี้ได้ไหม         
        $ChkTimeBookig = DB::table('booking_rooms')
            ->select('booking_time_start', 'booking_time_finish')
            ->where('booking_rooms.roomID', $request->roomID)
            ->where('booking_rooms.booking_status', '<>', 2)
            ->where('booking_rooms.schedule_startdate', '>=', $schedule_startdate)
            ->where('booking_rooms.schedule_enddate', '<=', $schedule_enddate)
            ->get();
            
        // ยืนยันการจอง
        $is_confirm = 1; $text ="";
        $error = true;
        foreach ($ChkTimeBookig as $row_chk) {

            $rowchkStart = str_replace(':', '', substr($row_chk->booking_time_start, 0, 5)); 
            $rowchkEnd = str_replace(':', '', substr($row_chk->booking_time_finish, 0, 5)); 

            if (
                ($bkstart >=  $rowchkStart  && $bkstart <  $rowchkEnd)
                ||
                ($bkfinish > $rowchkStart  && $bkfinish <=  $rowchkEnd)
                ||
                ($bkstart <  $rowchkStart && $bkfinish >  $rowchkEnd)
            ) {  
        
                $text = 'มีรายการจองของวันนี้แล้ว'.$bkstart.'_'.$bkfinish.'_'.$rowchkStart.'_'.$rowchkEnd;
                return response()->json([
                    'status' => 208,
                    'text' => ''
                ]);
                $error = 0;
                $is_confirm = 0;
            } 
        }
      //  $is_confirm =3;
        if ($error) {
            $bookingToken = md5(time());
            $filenames = "";
            $no = time();
            $result = "";
            $bookingtype = $request->booking_type;
            //บุคคลภายใน รอการอนุมัติ
            if (!empty($request->booker_cmuaccount)) {
               // $is_confirm = 3;
                $is_confirm = 1;
               if($request->session()->get('depTypeBooking')=="MAJOR"){
                 $is_confirm = 0;
                  $bookingtype = "major";
               }               
            }

            $txtTypeUser = "(บุคคลภายในคณะฯ)";
            if ($request->booking_type == "general") {
                $txtTypeUser = "(บุคคลภายนอกคณะฯ) ";
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
                'booking_type' =>  $bookingtype,
                'booking_at' => Carbon::now(),
                'booking_fileurl' => $fileName,
                'booking_status' => $is_confirm,
                'booking_code_cancel'=>$request->booking_code_cancel
            ];
                      
        $result = booking_rooms::create($setDataBooking);      
        if ($result) {
            $email_receipt = $request->booking_email;
            $lastInsertedId = $result->id;
            // SET  Data Payment     
                $setDataPayment = [
                'customerName' => $request->fullname_receipt,
                'customerEmail' => $email_receipt,
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
                    if($roomData->roomTypeId==3){
                        $roomtypeName="ห้องคอมพิวเตอร์";
                    }elseif($roomData->roomTypeId==2) {
                        $roomtypeName="ห้องเรียน";
                    }else {
                        $roomtypeName="ห้องประชุม";
                    }
                // ส่ง LINE                  
                $bookingRoom = $roomData->roomFullName;
                $booker = $request->booking_booker;
                $msgLine = "รายการจองใหม่ ".$txtTypeUser." %0A";
                $msgLine .= "เรื่อง : " .$request->booking_subject. "%0A";
                $msgLine .= "วันที่ : " .$request->schedule_startdate." เวลา ". $request->booking_time_start." ถึง ".$request->schedule_enddate." เวลา ". $request->booking_time_finish. "%0A";
                $msgLine .= $roomData->roomFullName. "%0A";
                $msgLine .= "ประเภทห้อง : ".$roomtypeName. "%0A";
                $msgLine .= "จาก : " . $booker." ". $request->booking_department. " (". $request->booking_phone .") %0A";             
                $msgLine .= "(จัดการ/ตรวจสอบการจองที่ https://e-roombook.eng.cmu.ac.th/admin/)";


                $uts = 0;
                $msgLineAdminRoom =   "รายการจองใหม่ %0A";
                $msgLineAdminRoom .= $roomData->roomFullName. " ที่ท่านดูแลได้อนุมัติใช้งาน%0A";
                $msgLineAdminRoom .= "เรื่อง : " .$request->booking_subject. "%0A";
                $msgLineAdminRoom .= "วันที่ : " .$request->schedule_startdate." เวลา ". $request->booking_time_start." ถึง ".$request->schedule_enddate." เวลา ". $request->booking_time_finish. "%0A";
                $msgLineAdminRoom .= "จาก : " . $booker." ". $request->booking_department. " (". $request->booking_phone .") %0A";              
                $msgLineAdminRoom .= "(ดูตารางการใช้งานของห้อง https://e-roombook.eng.cmu.ac.th/room/print/".$request->roomID."/".$uts."/".$roomData->roomFullName.")";

                //แจ้งข้อความเข้าผู้ดูแลห้อง
               $tokenUSer = $class->getlineTokenAdminRoom($request->roomID, 1);
               if ($tokenUSer) {
                    // lop หากมี Admin หลายคน                
                    foreach ($tokenUSer as $admins) {
                        $class->sendMessageTOline($admins->lineToken, $msgLineAdminRoom);
                    }
                }

                 // แจ้งข้อความเข้ากลุ่มผู้ดูแลห้อง 
                 //mMb96Ki0GrXKg21z4XARen0Hf32PL3imHuvOsxRFKCX Aod
                 //C9QQrrWUvNzwZ0GT3VhtRjvUKsPBJ72vzZjsGLpKRfi  ใช้จริง
                 $GrouplineToken ="C9QQrrWUvNzwZ0GT3VhtRjvUKsPBJ72vzZjsGLpKRfi";
                 $class->sendMessageTOline($GrouplineToken, $msgLine);


                if ($request->booking_type == "general") {
                    $msgreturn ="ท่านทำรายการสำเร็จ ทางทีมงานจะรีบดำเนินการตรวจสอบรายละเอียด และแจ้งผลให้ท่านทราบโดยด่วน ";
                }else {
                    $msgreturn ="ระบบทำรายการจองสำเร็จ";
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
        //$booking_code_cancel = $request->booking_code_cancel;
        $result = booking_rooms::find($bookingID);   
       // Session Login
        $cmuitaccount = $request->session()->get('cmuitaccount');
        if($result) {        
             $deletedRows =  DB::table('booking_rooms')
                ->where('id', $bookingID)
                ->where('booking_email',$cmuitaccount)
                ->delete();
            if ($deletedRows) {
                // ลบสำเร็จ
             return response()->json([
                    'status' => 200
              ]);
            }
        }
        
        return "No data found to delete."; 
     }   
     
}