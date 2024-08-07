<?php

namespace App\Http\Controllers\Admin;

use App\class\HelperService;
use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stepApporveController extends Controller
{
    // 
    public function index(Request $request)
    {
        $titlesCard = "รายการขอใช้ห้อง ที่รอการอนุมัติจากท่าน";
        if(($request->session()->get('cmuitaccount')) &&  ($request->session()->get('user_type'))){
           $email = $request->session()->get('cmuitaccount');

           $sql= " SELECT
                    booking_rooms.*,
                    stepappoves.is_status,
                    stepappoves.is_step,
                    stepappoves.email,
                    rooms.roomFullName,
                    rooms.roomDetail,
                    rooms.thumbnail
                    FROM
                    booking_rooms
                    INNER JOIN stepappoves ON booking_rooms.id = stepappoves.bookingID
                    INNER JOIN rooms ON booking_rooms.roomID = rooms.id
                    WHERE
                    stepappoves.email  ='{$email}' AND
                    stepappoves.is_status = 0
               
                ";

           $ResultBookingNew = DB::select(DB::raw($sql));
          
            return view('admin.stepApporve')->with([
                'title' => 'Dashboard',               
                'getBookingList' => $ResultBookingNew,
                'CountNewInbox' => $this->getCountNewBooking(),
                'CountApprove' => $this->getCountBooking_Approve(),
                'getStatus' => 'Newinbox',
                'titlesCard' => $titlesCard
            ]);
        
        }else{
            return redirect('admin/login')->with('message', 'Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
        }
          return 'ERROR';
    }

    public function bookingDetail(Request $request)
    {   //import  class  ระบบจัดการข้อมูลการจองมาใช้ 
        $importClass = new ManageBookingController();
       
       
        $getStatus = $request->getStatus;
        if ($request->bookingID) {
            $bookingId = $request->bookingID;
            // update Status read inbox อ่านแล้ว


            $updated = DB::table('stepappoves')->where('bookingID', $bookingId)
                ->update([
                    'is_read' => 1
                ]);

            //ข้อมูลหนักงาน Select option
             $sql = "SELECT
                    booking_assigns.*,
                    users.*,
                    department.dep_name                  
                    FROM
                    booking_assigns
                    INNER JOIN users ON booking_assigns.cmuitaccount = users.email
                    left JOIN department ON users.dep_id = department.dep_id
                    Where booking_assigns.bookingID='{$bookingId}'
                    ";
            $sclEmployee = DB::select(DB::raw($sql));

            //  รายละเอียดการจอง              
            $ResultBooking  =  $importClass->getDetailByBookingID($bookingId);
             //$json = json_encode($ResultBooking);
            return view('admin.apporve_detail')->with([
                'detailBooking' => $ResultBooking,
                'getStatus' => $getStatus,
                'sclEmployee' => $sclEmployee               
            ]);

        }
    }

     // Apponve 
    public function approveBooking(Request $request)
    {   
        $class = new HelperService();
        $bookingId = $request->hinden_bookingID;
        $actionStatus = $request->chkStatus;

        // update Step  สถานะส่งต่อผู้บริหาร  :  Admin อนุมัติเอง 
        $isStatus = ($actionStatus == 'ForwardDean') ? 2 : 1;



    }
     public function getCountNewBooking()
    {
        $Count = booking_rooms::where('booking_AdminAction', '')
            ->count();
        return $Count;
    }
     // return   จำนวนการจองที่ ส่งต่อแผู้บริหาร
    public function getCountBooking_Approve()
    {
        $Count = booking_rooms::where('booking_AdminAction', '=', 'approved')->count();
        return $Count;
    }




}