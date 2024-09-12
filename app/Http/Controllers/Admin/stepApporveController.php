<?php

namespace App\Http\Controllers\Admin;

use App\class\HelperService;
use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use App\Models\stepappove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class stepApporveController extends Controller
{
    // 
    public function index(Request $request)
    {
        $titlesCard = "รายการขอใช้ห้อง ที่รอการอนุมัติจากท่าน";
        if (($request->session()->get('cmuitaccount')) && ($request->session()->get('user_type'))) {
            $email = $request->session()->get('cmuitaccount');

            $sql = " SELECT
                    booking_rooms.*,
                    stepappoves.id as stepID,
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

        } else {
            return redirect('admin/login')->with('message', 'Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
        }
        //    return 'ERROR';
    }

    public function bookingDetail(Request $request)
    {   //import  class  ระบบจัดการข้อมูลการจองมาใช้ 
        $importClass = new ManageBookingController();

        $getStatus = $request->getStatus;
        if ($request->bookingID) {
            $bookingId = $request->bookingID;
            $stepapporveId = $request->stepapporveId;
            // update Status read inbox อ่านแล้ว
            $updated = DB::table('stepappoves')->where('id', $stepapporveId)
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
            $ResultBooking = $importClass->getDetailByBookingID($bookingId);
            //$json = json_encode($ResultBooking);
            return view('admin.apporve_detail')->with([
                'detailBooking' => $ResultBooking,
                'getStatus' => $getStatus,
                'sclEmployee' => $sclEmployee,
                'stepapporveId' => $stepapporveId

            ]);

        }
    }

    public function  listapprove_booking(Request $request) {
        $titlesCard = "รายการขอใช้ห้อง ที่ทำการการอนุมัติจากท่าน";
        if (($request->session()->get('cmuitaccount')) && ($request->session()->get('user_type'))) {
            $email = $request->session()->get('cmuitaccount');

            $sql = " SELECT
                    booking_rooms.*,
                    stepappoves.id as stepID,
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
                    stepappoves.is_status > 0
               
                ";

            $ResultBookingNew = DB::select(DB::raw($sql));

            return view('admin.listapprove_booking')->with([
                'title' => 'Dashboard',
                'getBookingList' => $ResultBookingNew,
                'CountNewInbox' => $this->getCountNewBooking(),
                'CountApprove' => $this->getCountBooking_Approve(),
                'getStatus' => 'Newinbox',
                'titlesCard' => $titlesCard
            ]);

        } else {
            return redirect('admin/login')->with('message', 'Session หมดอายุ กรุณาเข้าสู่ระบบใหม่');
        }
    }
    // Apponve 
    public function approveBooking(Request $request)
    {
        $class = new HelperService();
        $bookingId = $request->hinden_bookingID;
        $stepapporveId = $request->hinden_stepapporveId;

        $actionStatus = $request->chkStatus;

        // update Step  สถานะส่งต่อผู้บริหาร  :  Admin อนุมัติเอง 
        if ($actionStatus == 1) {
            $actionDetail = 'ส่งต่อผู้บริหาร';
        } elseif ($actionStatus == 3) {
            $actionDetail = 'อนุมัติรายการ โดยคณบดี';
        } else {
            $actionDetail = 'ไม่อนุมติรายการ';
        }

        //หาคนต่อไป 
        $getEmailNext = DB::table('users')
            ->select('users.user_type')
            ->where('users.email', $request->session()->get('cmuitaccount'))
            ->get();
        $userType = $getEmailNext[0]->user_type;

        $is_step = "";

        if ($stepapporveId) {
            $updated = DB::table('stepappoves')->where('id', $stepapporveId)
                ->update([
                    'is_status' => $actionStatus,
                    'action_detail' => $actionDetail,
                    'action_date' => Carbon::now()
                ]);

            if ($actionStatus == 1) {
                if ($userType == 'eng') {
                    $nextAccount = $class->getEmailStepAcction('secretary');
                    $is_step = 'secretary';
                } else if ($userType == 'secretary') {
                    $nextAccount = $class->getEmailStepAcction('deaneng');
                    $is_step = 'deaneng';
                } else if ($userType == 'deaneng') {
                    $nextAccount = $class->getEmailStepAcction('dean');
                    $is_step = 'dean';
                }
                if ($nextAccount) {
                    $setDataStep = [
                        'bookingID' => $bookingId,
                        'email' => $nextAccount,
                        'is_step' => $is_step
                    ];
                    $result = stepappove::create($setDataStep);
                    if ($result) {
                        
                       // $msgLine = "เรียนผู้บริหารมีรายการขอใช้ห้องมาใหม่...";
                       // $token = 'mMb96Ki0GrXKg21z4XARen0Hf32PL3imHuvOsxRFKCX';
                       // $class->sendMessageTOline($token, $msgLine);

                        $msgReturn = "อนุมัติรายการและทำการส่งต่อให้ผู้บริหารแล้ว";
                        return response()->json([
                            'status' => 200,
                            'message' => $msgReturn
                        ]);
                    }
                }
            } else {
                if ($actionStatus == 2) {
                    $dean_appove_status = 2;
                    $msgReturn = "ทำรายการปฏิเสธการข้อใช้ห้องเรียบร้อยแล้ว";
                }
                if ($actionStatus == 3) {
                    $dean_appove_status = 1;
                    $msgReturn = "อนุมัติรายการเรียบร้อยแล้ว";

                }
                $updated = DB::table('booking_rooms')->where('id', $bookingId)
                    ->update([
                        'dean_appove_status' => $dean_appove_status,
                        'dean_action_date' => Carbon::now(),
                        'dean_action_acount' => $request->session()->get('cmuitaccount'),
                        'is_read'=>0
                    ]);
                if ($updated) {

                   // $msgLine =  'เรียนผู้มีผุ้บริหารอนุมัติรายการจองห้องแล้วกรุณาตราวสอบ...';
                    //$token = 'mMb96Ki0GrXKg21z4XARen0Hf32PL3imHuvOsxRFKCX';
                    //$class->sendMessageTOline($token, $msgLine);
                    return response()->json([
                        'status' => 200,
                        'message' => $msgReturn
                    ]);
                    
                }
            }
        }
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