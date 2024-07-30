<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_assign;
use App\Models\customer_payment;
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
    public function bookingDetail(Request $request)
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
                $PaymentData = DB::table('customer_payment')      
                                ->select('customer_payment.*')
                ->where('bookingID', $bookingId)
                ->get();
                


            // Return รายละเอียดการจอง 
            $ResultBooking = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')             
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')                
                ->where('booking_rooms.id', $bookingId)
                ->get();

            return view('admin.bookingDetail')->with([
                'detailBooking' => $ResultBooking,
                'getStatus' => $getStatus,
                'sclEmployee' => $sclEmployee,
                'paymentInfo'=>$PaymentData
            ]);
        }
    }

    public function getAssignEmployee(Request $request)
    {
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
        'customerPhone' => $request->customerPhone,
        'customerTaxid' => $request->customerTaxid,
        'customerAddress' => $request->customerAddress,
        'totalAmount' => $request->totalAmount,
        'payment_status' => '0',
        'bookingID' => $request->hinden_bookingID
      
    ];
       if(empty($request->hiddin_custid)) {
          // insert 
           $insert = customer_payment::create($setData);
        }else{
            // Updates
            $result = customer_payment::find($request->hiddin_custid);

            $result->update($setData);
        }   

    }



}
