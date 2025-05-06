<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\class\HelperService;

class DashboardController extends Controller
{
    public function adminindex()
    {
        return redirect('/admin/login');
    }
    //Route admin.dashboard
    public function index(Request $request)
    {
        $class = new HelperService();
        $caseAdmin = 0;
       
        $user = "";
        $titlesCard = "รายการขอใช้ห้องมาใหม่";
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
        }
        $caseAdmin = (int)($class->chkAddminRoomType($request->session()->get('cmuitaccount')));
        // ห้องประชุม
        if($caseAdmin == 1 || $caseAdmin == 2 ){
            $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('rooms.roomTypeId',$caseAdmin) // เงื่อนไข roomTypeId = 1
            ->where(function ($query) {
                    $query->where('booking_rooms.booking_status', 0)
                    ->orWhere('booking_rooms.is_read', 0); // เงื่อนไข OR
                    
             })
            ->get();
        }else {
             $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_rooms.booking_status', '0')  
            ->where('booking_rooms.is_import_excel', '0')              
            ->orWhere('booking_rooms.is_read', '0')
    
            ->get();
        }


// update สถานะห้องเรียนที่จองมาใหม่จาก  excel 
      // update Status read inbox อ่านแล้ว
            $updated = DB::table('booking_rooms')->where('is_import_excel', '1')
                ->update([
                    'is_read' => 1
                ]);


        return view('admin.dashboard')->with([
            'title' => 'Dashboard',
            'sessionUser' => $user,
            'getBookingList' => $ResultBookingNew,
            'CountNewInbox' => $this->getCountNewBooking($caseAdmin),
            'CountCanceled' => $this->getCountBooking_Canceled($caseAdmin),
            'CountForward' => $this->getCountBooking_ForwardDean($caseAdmin),
            'CountApprove' => $this->getCountBooking_Approve($caseAdmin),
            'getStatus' => 'Newinbox',
            'titlesCard' => $titlesCard
        ]);
    }

    public function viewStatus(Request $request)
    {
        $caseAdmin =0;    
        $class = new HelperService();
        $caseAdmin = (int)($class->chkAddminRoomType($request->session()->get('cmuitaccount')));
        $getStatus = $request->getStatus;
        $user = "";
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
        }
        $titlesCard = "";
        if ($getStatus == 'Newinbox') {

            //ห้องประชุม
            if($caseAdmin ==1 ) {
                 $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                    ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                    ->where('rooms.roomTypeId', 1) // เงื่อนไข roomTypeId = 1
                    ->where(function ($query) {
                        $query->where('booking_rooms.booking_status', 0)
                            ->orWhere('booking_rooms.is_read', 0); // เงื่อนไข OR
                    })
               ->get();
            } elseif($caseAdmin ==2 ) {
                //  ห้องเรียน 
                $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('rooms.roomTypeId', 2) // เงื่อนไข roomTypeId = 1
                ->where('booking_rooms.is_import_excel', 0)  // เงื่อนไข is_import_excel = 0
                ->where(function ($query) {
                        $query->where('booking_rooms.booking_status', 0)
                            ->orWhere('booking_rooms.is_read', 0);// เงื่อนไข OR                         
                    })
               ->get();

            }else {
                // ALL LIST  Admin
            $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_rooms.is_import_excel', '0')   
                ->where(function ($query) {
                $query->where('booking_rooms.booking_status', 0)
                    ->orWhere('booking_rooms.is_read', 0);// เงื่อนไข OR                         
             })            
               ->get();
            }
                   
            $titlesCard = "รายการขอใช้ห้องมาใหม่ ";
        }
        if ($getStatus == 'ForwardDean') {
            if($caseAdmin == 1 || $caseAdmin == 2 ){
                  $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_AdminAction', '=', 'ForwardDean')
                ->where('dean_appove_status', 0)
                ->where('rooms.roomTypeId', $caseAdmin)
                ->get();
            } else {
                  $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_AdminAction', '=', 'ForwardDean')
                ->where('dean_appove_status', 0)
                ->get();
            }
            $titlesCard = "รายการขอใช้ห้องที่ทำการส่งต่อผู้บริหาร";
        }
        if ($getStatus == 'canceled') {
             if($caseAdmin == 1 || $caseAdmin == 2 ){
                 $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_AdminAction', '=', 'canceled')
                 ->where('rooms.roomTypeId', $caseAdmin)
                ->get();
          
             }else {
                $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_AdminAction', '=', 'canceled')                
                ->get();
             }
               $titlesCard = "รายการขอใช้ห้องที่ทำการยกเลิก";
        }
        if ($getStatus == 'approved') {
              if($caseAdmin == 1 || $caseAdmin == 2 ){
                 $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')    
                ->where('rooms.roomTypeId', $caseAdmin)   
                ->where('booking_rooms.is_import_excel', 0)          
                ->where(function($query) {
                    $query->where('dean_appove_status', 1)                          
                          ->orWhere('booking_AdminAction', 'approved')
                          ->orWhere('booking_status', '1') ;                      
                })
                ->get();
              }else {
                $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                    ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')               
                    ->where(function($query) {
                    $query->where('dean_appove_status', 1)                          
                          ->orWhere('booking_AdminAction', 'approved')
                          ->orWhere('booking_status', '1') ;                         
                })
                ->where('is_import_excel', 0)
                ->get();
              }
            $titlesCard = "รายการขอใช้ห้องที่ทำการอนมุัติ";
        }

        return view('admin.dashboard')->with([
            'title' => 'Dashboard',
            'sessionUser' => $user,
            'getBookingList' => $ResultBookingNew,
            'CountNewInbox' => $this->getCountNewBooking($caseAdmin),
            'CountCanceled' => $this->getCountBooking_Canceled($caseAdmin),
            'CountForward' => $this->getCountBooking_ForwardDean($caseAdmin),
            'CountApprove' => $this->getCountBooking_Approve($caseAdmin),
            'getStatus' => $getStatus,
            'titlesCard' => $titlesCard
        ]);
    }

    // return   จำนวนการจอง ที่ยังไม่ได้อนุมัติ
    public function getCountNewBooking($caseAdmin)
    {
        if($caseAdmin == 1 || $caseAdmin == 2 ){
            $Count = booking_rooms:: join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
              ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail') 
              ->where('rooms.roomTypeId', $caseAdmin)       
                 
              ->where(function($query) {
                    $query->where('booking_rooms.booking_status', 0)                          
                          ->orWhere('booking_rooms.is_read', 0);
                })->count();
        }else {
            $Count = booking_rooms:: where('booking_status', '0')
               ->orWhere('booking_rooms.is_read', '0')
              ->count();
        }
        
        return $Count;
    }

    // return   จำนวนการจองที่ ยกเลิก
    public function getCountBooking_Canceled($caseAdmin)
    {
         if($caseAdmin == 1 || $caseAdmin == 2 ){
             $Count = booking_rooms:: join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail') 
             ->where('rooms.roomTypeId', $caseAdmin)           
             ->where('booking_cancel',  1)->count();
         }else {
            $Count = booking_rooms:: join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail') 
            ->where('booking_cancel', 1)->count();
         }
  
        return $Count;
    }

    // return   จำนวนการจองที่ ส่งต่อแผู้บริหาร
    public function getCountBooking_ForwardDean($caseAdmin)
    {
         if($caseAdmin == 1 || $caseAdmin == 2 ){
            $Count = booking_rooms:: join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
        ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')          
        ->where('booking_AdminAction', '=', 'ForwardDean')
        ->where('rooms.roomTypeId', $caseAdmin)           
        ->where('dean_appove_status', 0)->count();

         }else {
              $Count = booking_rooms:: join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
        ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')          
        ->where('booking_AdminAction', '=', 'ForwardDean')      
        ->where('dean_appove_status', 0)->count();
         }
      
        return $Count;
    }

    // return   จำนวนการจองที่ approved
    public function getCountBooking_Approve($caseAdmin)
    {
         if($caseAdmin == 1 || $caseAdmin == 2 ){
     $Count = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
        ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail') 
            ->where('rooms.roomTypeId', $caseAdmin)   
            ->where('booking_rooms.is_import_excel', 0)     
            ->where(function($query) {
                        $query->where('booking_rooms.booking_AdminAction', '=', 'approved')                         
                            ->orWhere('booking_rooms.dean_appove_status', 0)
                            ->orWhere('booking_rooms.booking_status', '1');
            })->count();

         }else {
        $Count = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
        ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail') 
        ->where('booking_rooms.is_import_excel', 0)     
        ->where(function($query) {
                    $query->where('booking_rooms.booking_AdminAction', '=', 'approved')                         
                          ->orWhere('booking_rooms.dean_appove_status', 0)
                          ->orWhere('booking_rooms.booking_status', '1');
        })->count();
    }
        return $Count;
    }

    public function bookingDetail(Request $request)
    {
        $bookingId = $request->id;
        $ResultBooking = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_rooms.id', $bookingId)
            ->get();
        
          
                    
        $userRequest = "";
        $times = "";

        foreach ($ResultBooking as $rows) {
            if ($rows["booking_zoom"])
                $userRequest .= " ZOOM ,";
            if ($rows["booking_computer"])
                $userRequest .= " คอมพิวเตอร์ ,";
            if ($rows["booking_camera"])
                $userRequest .= " ช่างภาพ/บันทึกภาพ ,";
            if ($rows["booking_food"])
                $userRequest .= " อาหารและเครื่องดื่ม ,";

            $roomFullName = $rows["roomFullName"];
            $roomID = $rows["roomID"];
            $booking_date = $rows["booking_date"];
            $booking_time = $rows["booking_time_start"] . "-" . $rows["booking_time_finish"];
            $booking_subject = $rows["booking_subject"];
            $booking_booker = $rows["booking_booker"];
            $booking_ofPeople = $rows["booking_ofPeople"];
            $booking_department = $rows["booking_department"];
            $bookingToken = $rows["bookingToken"];
            $description = $rows["description"];
            $booking_at = $rows["booking_at"];
            $booking_email = $rows["booking_email"];
            $booking_phone = $rows["booking_phone"];
            $booking_status = $rows["booking_status"];
            $booking_no = $rows["booking_no"];
        }
        return response()->json([
            'status' => 200,
            'roomFullName' => $roomFullName,
            'roomID' => $roomID,
            'booking_date' => $booking_date,
            'booking_time' => $booking_time,
            'booking_subject' => $booking_subject,
            'booking_booker' => $booking_booker,
            'booking_ofPeople' => $booking_ofPeople,
            'booking_department' => $booking_department,
            'bookingToken' => $bookingToken,
            'description' => $description,
            'booking_at' => $booking_at,
            'booking_email' => $booking_email,
            'booking_phone' => $booking_phone,
            'booking_status' => $booking_status,
            'booking_no' => $booking_no,
            'userRequest' => $userRequest,
            'admin_action_date' => $rows["admin_action_date"],
            'admin_action_acount' => $rows["admin_action_acount"]
        ]);
    }


}