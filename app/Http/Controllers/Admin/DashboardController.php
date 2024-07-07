<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function  adminindex()
    {
        return redirect('/admin/login');
    }


    //Route admin.dashboard
    public function index(Request $request)
    {
        $user = "";
        $titlesCard = "รายการขอใช้ห้องมาใหม่";
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
        }

        $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_status', 0)
            ->get();

        return view('admin.dashboard')->with([
            'title' => 'Dashboard',
            'sessionUser' => $user,
            'getBookingList' => $ResultBookingNew,
            'CountNewInbox' => $this->getCountNewBooking(),
            'CountCanceled' => $this->getCountBooking_Canceled(),
            'CountForward' => $this->getCountBooking_ForwardDean(),
            'CountApprove' => $this->getCountBooking_Approve(),
            'getStatus' => 'Newinbox',
            'titlesCard' => $titlesCard
        ]);
    }

    public function viewStatus(Request $request)
    {

        $getStatus = $request->getStatus;
        $user = "";
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
        }
        $titlesCard = "";
        if ($getStatus == 'Newinbox') {
            $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_status', 0)
                ->get();
            $titlesCard  = "รายการขอใช้ห้องมาใหม่ ";
        }
        if ($getStatus == 'ForwardDean') {
            $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_AdminAction', '=', 'ForwardDean')
                ->get();
            $titlesCard  = "รายการขอใช้ห้องที่ทำการส่งต่อผู้บริหาร";
        }
        if ($getStatus == 'canceled') {
            $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_AdminAction', '=', 'canceled')
                ->get();
            $titlesCard  = "รายการขอใช้ห้องที่ทำการยกเลิก";
        }
        if ($getStatus == 'approved') {
            $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_AdminAction', '=', 'approved')
                ->get();
            $titlesCard  = "รายการขอใช้ห้องที่ทำการอนมุัติ";
        }

        return view('admin.dashboard')->with([
            'title' => 'Dashboard',
            'sessionUser' => $user,
            'getBookingList' => $ResultBookingNew,
            'CountNewInbox' => $this->getCountNewBooking(),
            'CountCanceled' => $this->getCountBooking_Canceled(),
            'CountForward' => $this->getCountBooking_ForwardDean(),
            'CountApprove' => $this->getCountBooking_Approve(),
            'getStatus' => $getStatus,
            'titlesCard' => $titlesCard
        ]);
    }

    // return   จำนวนการจอง ที่ยังไม่ได้อนุมัติ
    public function getCountNewBooking()
    {
        $Count = booking_rooms::where('booking_status', '=', 0)->count();
        return $Count;
    }

    // return   จำนวนการจองที่ ยกเลิก
    public function getCountBooking_Canceled()
    {
        $Count = booking_rooms::where('booking_cancel', '=', 1)->count();
        return $Count;
    }

    // return   จำนวนการจองที่ ส่งต่อแผู้บริหาร
    public function getCountBooking_ForwardDean()
    {
        $Count = booking_rooms::where('booking_AdminAction', '=', 'ForwardDean')->count();
        return $Count;
    }

    // return   จำนวนการจองที่ ส่งต่อแผู้บริหาร
    public function getCountBooking_Approve()
    {
        $Count = booking_rooms::where('booking_AdminAction', '=', 'approved')->count();
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
            'admin_action_date' =>  $rows["admin_action_date"],
            'admin_action_acount' =>  $rows["admin_action_acount"]


        ]);
    }

    // 
    public function approveBooking(Request $request)
    {
        $bookingId = $request->hinden_bookingID;
        $actionStatus = $request->chkStatus;

        // update Step  สถานะส่งต่อผู้บริหาร  :  Admin อนุมัติเอง 
        $isStatus = ($actionStatus == 'ForwardDean') ? 2 : 1;

        // เก็บประวัติการยกเลิกรายการจอง
        $isstatusCanceled = ($actionStatus == 'canceled') ? 1 : 0;

        // Message return 
        if ($actionStatus == 'ForwardDean') {
            $msg = " ส่งต่อให้ผู้บริหารพิจราณาเรียบร้อยแล้ว ";
        } else if ($actionStatus == 'canceled') {
            $msg = " ทำรายการยกเลิกรายการเรียบร้อยแล้ว ";
        } else {
            $msg = " ทำการอนุมัติ รายการจองเรียบร้อยแล้ว ";
        }

        // Apponve step 
        if ($bookingId) {
            $updated = DB::table('booking_rooms')->where('id', $bookingId)
                ->update([
                    'booking_status' => $isStatus,
                    'booking_AdminAction' => $actionStatus,
                    'booking_cancel' => $isstatusCanceled,
                    'admin_action_date' => Carbon::now(),
                    'admin_action_acount' => $request->adminAccount
                ]);
            if ($updated) {
                return response()->json([
                    'status' => 200,
                    'message' => $msg
                ]);
            }
        }
    }
}
