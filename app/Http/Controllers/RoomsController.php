<?php

namespace App\Http\Controllers;

use App\class\HelperService;
use App\Models\adminRooom;
use App\Models\room_gallery;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomsController extends Controller
{
    public function index()
    {
        //ประเภทห้อง 
        $roomType = DB::table('room_type')
            ->select('id', 'roomtypeName')
            ->get();
        // สถานที่     
        $roomPlace = DB::table('place')
            ->select('id', 'placeName')
            ->get();

        // room Accessories    
        $roomItems = DB::table('room_items')
            ->select('id', 'item_name')
            ->get();

        //ข้อมูลหนักงาน Select option
        $sclEmployee = DB::table('users')
            ->select('users.*')
            ->get();
        return view("/admin/room/index")->with([
            'getroomType' => $roomType,
            'getroomPlace' => $roomPlace,
            'sclEmployee' => $sclEmployee,
            'roomItemList' => $roomItems
        ]);
    }
    // handle fetch all  ajax request
    public function fetchAll()
    {


        $rowsRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
            ->join('place', 'place.id', '=', 'rooms.placeId')
            ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
            ->get();

        $output = '';
        if ($rowsRoom->count() > 0) {
            $output .= '
            <div class="table-responsive">
        <table class="table table-striped table-sm text-left align-middle w-100" id="tableListRoomALl">
        <thead>
          <tr>
            <th>#</th>
            <th></th>
            <th>ห้อง</th>
              <th>ประเภท</th>
                <th>สถานที่ </th>
            <th>รายละอียด</th>          
            <th>สถานะ</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
            foreach ($rowsRoom as $rows) {
                if (!empty($rows->thumbnail)) {
                    $img = '/storage/images/' . $rows->thumbnail;
                } else {
                    $img = '/storage/images/noinages.png';
                }

                $isOpen = ($rows->is_open) ? '<span class="badge text-bg-success  badge-success">เปิดปกติ</span>' : '<span class="badge text-bg-danger  badge-danger">ปิดการใช้</span>';
                $output .= '<tr class="text-start">
            <td>' . $rows->id . '</td>
            <td  class="text-left"><img src="' . $img . '"  class="img-thumbnail "  width="100" ></td>
            <td>' . $rows->roomFullName . '</td>
             <td>' . $rows->roomtypeName . '</td>
             <td>' . $rows->placeName . '</td>
            <td>' . $rows->roomDetail . '</td>           
            <td>' . $isOpen . '</td>
            <td  width="120" >
              <a href="#" id="' . $rows->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi-pencil-square h5"></i></a>
 <a href="/admin/room/getAdmin/' . $rows->id . '"  class="text-success mx-1 " ><i class="bi bi-person-fill-gear h5"></i></a>
              <a href="#" id="' . $rows->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h5"></i></a>
            </td>
          </tr>';
            }
            $output .= '</tbody></table></div>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    function convertArrayToComma($dataArr)
    {
        $val = implode(",", $dataArr);
        return $val;
    }
    public function store(Request $request)
    {
        $fileName = "";
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
        }

        $roomToken = md5(time());
        $roomTitle =  str_replace(' ', '', $request->roomFullName);
        $itemlist =  $this->convertArrayToComma($request->room_itemlist);   


        $setData = [
            'roomToken' => $roomToken,
            'roomFullName' => $request->roomFullName,
            'roomTitle' => $roomTitle,
            'roomSize' => $request->roomSize,
            'roomTypeId' => $request->roomTypeId,
            'placeId' => $request->placeId,
            'roomDetail' => $request->roomDetail,
            'thumbnail' => $fileName,
            'room_wh' => $request->room_wh,
            'room_itemlist'=>$itemlist
        ];
        Rooms::create($setData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an employee ajax request
    public function edit(Request $request)
    {
        // $id = $request->id;
        // room Accessories    
        $roomItems = DB::table('room_items')
            ->select('id', 'item_name')
            ->get();

        $result = Rooms::find($request->id);
        $result2 = json_encode($result);
        return response()->json([
            'status' => 200,
            'dataRoom' => $result2,
            'roomItemList' => $roomItems
        ]);
    }

    public function addAdmin(Request $request)
    {
        $setData = [
            'roomID' => $request->roomID,
            'cmuitaccount' => $request->cmuitaccount,
            'phone' => $request->phone,
            'adminroom_type_id'=>$request->adminroom_type_id

        ];
        $result = adminRooom::create($setData);
        if ($result) {
            return response()->json([
                'status' => 200
            ]);
        }
    }

    public function deleteAdmin(Request $request)
    {
        $id = $request->id;
        $result = adminRooom::find($id);
        if ($result) {
            adminRooom::destroy($id);
        }
    }


    public function editAdmin(Request $request)
    {
        // $id = $request->id;
        //$result = adminRooom::find($request->roomid);
        if ($request->roomid) {
            $sql = " SELECT
           admin_roooms.*,
           users.*,
           department.dep_name,
           rooms.roomFullName,
           rooms.roomTitle
           FROM
           admin_roooms
           INNER JOIN users ON admin_roooms.cmuitaccount = users.email
           left JOIN department ON users.dep_id = department.dep_id
           INNER JOIN rooms ON admin_roooms.roomID = rooms.id ";
            $ListAdmin = DB::select(DB::raw($sql));
            return response()->json([
                'status' => 200,
                'ListAdmin' => $ListAdmin
            ]);
        }
    }

    public function pageAdmin(Request $request)
    {
        //ข้อมูลหนักงาน Select option
        $sclEmployee = DB::table('users')
            ->select('users.*')
            ->get();
      
        // $id = $request->id;
        if ($request->roomID) {
            $roomData = Rooms::find($request->roomID);

            $sql = " SELECT
            admin_roooms.*,
            users.*,
            department.dep_name,
            rooms.roomFullName,
            rooms.roomTitle,
            adminroom_type.type_name
            FROM
            admin_roooms
            INNER JOIN users ON admin_roooms.cmuitaccount = users.email
            left JOIN department ON users.dep_id = department.dep_id
            INNER JOIN rooms ON admin_roooms.roomID = rooms.id 
            left JOIN adminroom_type ON admin_roooms.adminroom_type_id = adminroom_type.type_id
            where   admin_roooms.roomID = " . $request->roomID;
            $ListAdmin = DB::select(DB::raw($sql));
            return view("admin/room/manageAdmin")->with([
                'ListAdmin' => $ListAdmin,
                'sclEmployee' => $sclEmployee,
                'roomData' =>$roomData
            ]);
        }
    }


    public function fetchAdmin(Request $request)
    {
        // $id = $request->id;
        if ($request->roomID) {
            
            $roomData = Rooms::find($request->roomID);
            $sql = " SELECT
             admin_roooms.id as AdminId,
            admin_roooms.roomID,
            admin_roooms.cmuitaccount,
            admin_roooms.phone,
            admin_roooms.adminroom_type_id,
            users.*,
            department.dep_name,
            rooms.roomFullName,
            rooms.roomTitle,
            adminroom_type.type_name
            FROM
            admin_roooms
            INNER JOIN users ON admin_roooms.cmuitaccount = users.email
            left JOIN department ON users.dep_id = department.dep_id
            INNER JOIN rooms ON admin_roooms.roomID = rooms.id 
            left JOIN adminroom_type ON admin_roooms.adminroom_type_id = adminroom_type.type_id
            where   admin_roooms.roomID = '{$request->roomID}' ";
            $ListAdmin = DB::select(DB::raw($sql));
          //  if($ListAdmin){
                return response()->json([
                    'ListAdmin' => $ListAdmin ,
                    'roomData' =>$roomData
                ]);
          //   }
              
               
             
        }
    }

    // handle update an  ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $RoomOpen = false;
        $result = Rooms::find($request->room_id);
        $roomTitle =  str_replace(' ', '', $request->roomFullName);
        $itemlist =  $this->convertArrayToComma($request->room_itemlist);   
        
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($result->Edit_thumbnail) {
                Storage::delete('public/images/' . $result->Edit_thumbnail);
            }
        } else {
            $fileName = $request->Edit_thumbnail;
        }
        if ($request->is_open == 'on') {
            $RoomOpen = true;
        }
        $setData = [
            'roomFullName' => $request->roomFullName,
            'roomTitle' => $roomTitle,
            'roomSize' => $request->roomSize,
            'roomTypeId' => $request->roomTypeId,
            'placeId' => $request->placeId,
            'roomDetail' => $request->roomDetail,
            'thumbnail' => $fileName,
            'is_open' => $RoomOpen,
            'room_wh' => $request->room_wh,
            'room_itemlist'=>$itemlist
        ];
        $result->update($setData);
        return response()->json([
            'status' => 200           
        ]);
    }

    // handle delete  ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $result = Rooms::find($id);
        if (Storage::delete('public/images/' . $result->thumbnail)) {
            Rooms::destroy($id);
        }
    }

    public function detail(Request $request)
    {

        $itemlist[]="";
        if ($request->roomId) {
            $roomId = $request->roomId;
            //`room_galleries` 
            $getgallery = room_gallery::join('rooms', 'rooms.id', '=', 'room_galleries.roomID')
                ->select('filename', 'rooms.roomFullName')->where('roomID', $roomId)->get();

            $listRoom = Rooms::join('room_type', 'room_type.id', '=', 'rooms.roomTypeId')
                ->join('place', 'place.id', '=', 'rooms.placeId')
                ->select('rooms.*', 'place.placeName', 'room_type.roomtypeName')
                ->where('rooms.id', '=', $roomId)
                ->get();
                
            if($listRoom[0]->room_itemlist){
                $itemlist  =  DB::select(DB::raw('SELECT * FROM `room_items` WHERE room_items.id IN ('. $listRoom[0]->room_itemlist.')')); 
            }
           
            //url CMU Outh 
            $cmuKey = DB::table('tbl_apikey')
                ->select('clientID', 'clientSecret', 'redirect_uri')
                ->where('apiweb', '=', 'cmuoauth')
                ->first();
            $signwithCmu = 'https://oauth.cmu.ac.th/v1/Authorize.aspx?response_type=code&client_id=' . $cmuKey->clientID . '&redirect_uri=' . $cmuKey->redirect_uri . '&scope=cmuitaccount.basicinfo&state=booking-' . $roomId;


            $roomTitle = trim($listRoom[0]->roomFullName);
            return view("room/detail")->with([
                'getListRoom' => $listRoom,
                'roomGallery' => $getgallery,
                'roomTitle' => $roomTitle,
                'urlCMUOauth' => $signwithCmu,
                'listItemRoom'=>  $itemlist
            ]);
        }
    }


   // TV  SCINET
    public function displayTvSciNet(Request $request)
    {  
  
        date_default_timezone_set('Asia/Bangkok');   
       $class = new HelperService();
        // GET ROOMID 
        if ($request->roomId) {
            $roomId = $request->roomId;
            $dataroom = Rooms::find($roomId);      

            // NOW DATE
            $dateNow = date('Y-m-d');
            $timeNow = date('Y/m/d H:i:s');	
            $temptimes = 	explode(" ",$timeNow);
            $timeNow =$temptimes[1];
		
            $is_time =   $class->get_TimenowConvert($timeNow);
         
            $MONTH = array("","January","February" ,"March","April","May","June", "July", "August" , "September", "October","November","December");

            // convert  to Date  Display
            //04 September 2024
            $tempdate =  explode("-",$dateNow);
            $DateTitlePage = $tempdate[2]." ". $MONTH[(int)$tempdate[1]]." ".((int)$tempdate[0]);   
          

            //วันที่ปัจจุบัน
            $datenowQry = date('Y-m-d');

             // Query Booking room Table 
                 $sql= "SELECT
                    booking_rooms.*,
                    rooms.roomFullName
                  
                    FROM
                    booking_rooms
                    INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                    WHERE
                    booking_rooms.roomID = '{$roomId}' AND
                    (
                    booking_rooms.schedule_startdate = '{$datenowQry}'                    
                    )
                    AND  ( booking_status = 1 OR  booking_status = 3 )

                    ORDER BY
                    booking_rooms.booking_time_start ASC";
                    $listBooking = DB::select(DB::raw($sql));
            
   

                   
            //$roomTitle = $dataroom->roomFullName;
            $roomTitle= ($roomId==6) ? "ห้องประชุม(ข้างห้อง วสท.)":$dataroom->roomFullName;
            return view("room/scinet")->with([
                'DateTitlePage' => $DateTitlePage,  
                'getTimeNow' =>$is_time,
                'RoomTitle' =>$roomTitle,
                'listBookingRoom' => $listBooking
            ]);

        }
    }
               
    public function print_schedule (Request $request)
    {    
         date_default_timezone_set('Asia/Bangkok');   
         $class = new HelperService();

         if ($request->roomId) {
            $roomID =$request->roomId;
            $dataroom = Rooms::find($roomID);
         }

        return view("/room/print_schedule")->with([
            'dataroom' => $dataroom ,
            'getust' => $request->uts
        ]);
    }

}