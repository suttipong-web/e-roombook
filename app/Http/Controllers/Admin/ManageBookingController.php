<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_assign;
use App\Models\payments;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\booking_rooms;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManageBookingController extends Controller
{
    //
    public function index(Request $request)
    {
    }
    public function mbookingDetail(Request $request)
    {
        //ข้อมูลหนักงาน Select option
        $sclEmployee = DB::table('tbl_members')
            ->select('tbl_members.*')
            ->get();

        $getStatus = $request->getStatus;
        if ($request->bookingID) {
            $bookingId = $request->bookingID;
            // update Status read inbox อ่านแล้ว
            $updated = DB::table('booking_rooms')->where('id', $bookingId)
                ->update([
                    'is_read' => 1
                ]);

            // Return รายละเอียดการจอง 
                $ResultBooking  = $this->getDetailByBookingID($bookingId);
             //$json = json_encode($ResultBooking);
            return view('admin.bookingDetail')->with([
                'detailBooking' => $ResultBooking,
                'getStatus' => $getStatus,
                'sclEmployee' => $sclEmployee               
            ]);

        }
    }

    public   function  getDetailByBookingID($bookingId){

        $sql = " SELECT
        booking_rooms.*,
        booking_rooms.updated_at,
        payments.id AS paymentid,
        payments.payment_ref1,
        payments.payment_ref2,
        payments.customerName,
        payments.customerEmail,
        payments.customerPhone,
        payments.organization,
        payments.customerTaxid,
        payments.customerAddress,
        payments.totalAmount,
        payments.payment_status,
        payments.is_confirm,
        payments.payment_date,
        rooms.roomFullName,
        rooms.roomSize,
        rooms.thumbnail,
        rooms.roomDetail
        FROM
        booking_rooms
        left JOIN payments ON booking_rooms.id = payments.bookingID
        INNER JOIN rooms ON rooms.id = booking_rooms.roomID
        where booking_rooms.id = '{$bookingId}' ";
        $ResultBooking =  DB::select(DB::raw($sql));
        return  $ResultBooking;
    }


    public function getAssignEmployee(Request $request)    {
        if ($request->bookingId) {
            $sql = "SELECT
                    booking_assigns.*,
                    tbl_members.*,
                    department.dep_name                  
                    FROM
                    booking_assigns
                    INNER JOIN tbl_members ON booking_assigns.cmuitaccount = tbl_members.cmuitaccount
                    left JOIN department ON tbl_members.dep_id = department.dep_id
                    Where booking_assigns.bookingID='{$request->bookingId}'
                    ";
            $qresult = DB::select(DB::raw($sql));
            if ($qresult) {
                return response()->json([
                    'listemp' => $qresult
                ]);
            }
        }
    }

    public function assignEmployee(Request $request)
    {
        if ($request->cmuitaccount) {
            $setData = [
                'cmuitaccount' => $request->cmuitaccount,
                'bookingID' => $request->bookingId,
                'is_read' => 0
            ];
            $insert = booking_assign::create($setData);
            if ($insert) {
                return response()->json([
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'status' => 208,
                    'error' => 'ERROR'
                ]);
            }
        }

    }

    public function deleteAssign(Request $request)
    {
        $id = $request->id;
        $result = booking_assign::find($id);
        if ($result) {
            booking_assign::destroy($id);
        }
    }
    public function printFormBooking (Request $request) {
        if ($request->bookingID) {
            $bookingId = $request->bookingID;
            $ResultBooking = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_rooms.id', $bookingId)
            ->get();
            $sql = "SELECT
            booking_assigns.*,
            tbl_members.*,
            department.dep_name
            FROM
            booking_assigns
            INNER JOIN tbl_members ON booking_assigns.cmuitaccount = tbl_members.cmuitaccount
            left JOIN department ON tbl_members.dep_id = department.dep_id
            Where booking_assigns.bookingID='{$bookingId}'
            ";
            $ListEmployee = DB::select(DB::raw($sql));
            return view('printformbooking')->with([
                'detailBooking' => $ResultBooking,         
                'ListEmployee' => $ListEmployee
            ]);
        }
        return view('printformbooking') ->with([
            'Error' => 'ไม่สามารถทำรายการได้'     
        ]);

    }
    public function setdataPayment (Request $request) {
       $bookingId = $request->hinden_bookingID;   
       $setData = [
        'customerName' => $request->customerName,
        'customerEmail' => $request->customerEmail,
        'customerPhone' =>'',
        'customerTaxid' => $request->customerTaxid,
        'customerAddress' => $request->customerAddress,
        'totalAmount' => $request->totalAmount,
        'payment_status' => '0',
        'bookingID' => $bookingId     
    ];  
       if(empty($request->hinden_paymentid)) {
            // insert 
           $insert = payments::create($setData);
           if ($insert) {
                return response()->json([
                    'status' => 200
                ]);
           } 
        }else{
            // Updates
            $result = payments::find($request->hinden_paymentid);
            $result->update($setData);
            if ($result) {
                return response()->json([
                    'status' => 200
                ]);
           } 
        }   
         
        return response()->json([
                'status' => 208,
                'error' => 'ERROR'
         ]);
    }


    // Apponve 
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
                if ($actionStatus == 'approved') {
                    $this->setAuthPayment($bookingId);
                }
                return response()->json([
                    'status' => 200,
                    'message' => $msg,
                    'pagestatus'=>$actionStatus
                ]);
            }
        }
    }

    public function setAuthPayment ($bookingID){
        $ResultBooking  = $this->getDetailByBookingID($bookingID);
        $engpaymentkey = $this->getAPIKEYPayment();        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://payment.eng.cmu.ac.th/api/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "APIKEY": "'.$engpaymentkey.'",
            "customer_Name":"'.$ResultBooking["customerName"].'",
            "customer_Taxid":"'.$ResultBooking["customerTaxid"].'",
            "customer_Phone":"'.$ResultBooking["customerPhone"].'",
            "customer_Email":"'.$ResultBooking["customerName"].'",
            "customer_Address":"'.$ResultBooking["customerAddress"].'",
            "Amount":"'.$ResultBooking["totalAmount"].'",	
            "reUrl":"https://e-roombooking.eng.cmu.ac.th/paid"      
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;

    }




}
