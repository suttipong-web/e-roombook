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
use App\class\HelperService;
use App\Models\stepappove;
use App\Models\User;

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

        // เพิ่มข้อมมูลผู้ดูแลห้อง
     /*   $sclEmployee = DB::table('tbl_members')
        ->select('tbl_members.*')
        ->get();
*/

        /*$setData = [
            'cmuitaccount' => $request->cmuitaccount,
            'bookingID' => $request->bookingId,
            'is_read' => 0
        ];
        $insert = booking_assign::create($setData);     
*/



            //  $this->setAuthPayment($bookingId);
            // Return รายละเอียดการจอง 
            $ResultBooking = $this->getDetailByBookingID($bookingId);
            //$json = json_encode($ResultBooking);
            return view('admin.bookingDetail')->with([
                'detailBooking' => $ResultBooking,
                'getStatus' => $getStatus,
                'sclEmployee' => $sclEmployee
            ]);

        }
    }

    public function getDetailByBookingID($bookingId)
    {

        $sql = " SELECT
        booking_rooms.*,
        booking_rooms.updated_at,
        payments.id AS paymentid,
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
        payments.customerToken,
        payments.urlPayment,
        payments.addfile1,
        payments.addfile2,
        rooms.roomFullName,
        rooms.roomSize,
        rooms.thumbnail,
        rooms.roomDetail
        FROM
        booking_rooms
        left JOIN payments ON booking_rooms.id = payments.bookingID
        INNER JOIN rooms ON rooms.id = booking_rooms.roomID
        where booking_rooms.id = '{$bookingId}' ";
        $ResultBooking = DB::select(DB::raw($sql));
        return $ResultBooking;
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
    public function printFormBooking(Request $request)
    {
        $class = new HelperService();
        if ($request->bookingID) {
            $bookingId = $request->bookingID;
            $ResultBooking = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName','rooms.roomTypeId', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_rooms.id', $bookingId)
                ->get();
if($ResultBooking[0]->roomTypeId == 1){
    $subjectdoc ="หัวหน้างานบริหารทั่วไป"   ;
}else {
   $subjectdoc ="รองคณบดี (ผู้ช่วยศาสตราจารย์ ดร.พฤษภ์ บุญมา)"   ; 
}
    //ห้องประชุม
   


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
            $ListEmployee = DB::select(DB::raw($sql));
            if (empty($ListEmployee)) {
                //แจ้งข้อความเข้าผู้ดูแลห้อง
                $getUSer = $class->getlineTokenAdminRoom($ResultBooking[0]->roomID, 1);
                if ($getUSer) {
                     // lop หากมี Admin หลายคน                
                     foreach ($getUSer as $admins) {           
                          // เพิ่มผู้ดูแลห้องเข้าไปในรายการ                         
                          $setData = [
                             'cmuitaccount' =>$admins->cmuitaccount,
                             'bookingID' =>$bookingId ,
                             'is_read' => 0
                          ];
                           $insert = booking_assign::create($setData);     
 
                     }
                 } 
                 $ListEmployee ="";              
            }

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
            $ListEmployee = DB::select(DB::raw($sql));


            return view('printformbooking')->with([
                'detailBooking' => $ResultBooking,
                'ListEmployee' => $ListEmployee,
                'subjectdoc' => $subjectdoc,
            ]);
        }
        return view('printformbooking')->with([
            'Error' => 'ไม่สามารถทำรายการได้'
        ]);

    }
    public function setdataPayment(Request $request)
    {
        $bookingId = $request->hinden_bookingID;

            $fileNameAddFile1="";
            $fileNameAddFile2="";
            // Handle the file upload
            if ($request->hasFile('addfile1')) {
                $file = $request->file('addfile1');
                $fileNameAddFile1 = time() . '.' . $file->getClientOriginalExtension();
               $file->move(public_path('upload'), $fileNameAddFile1);
            }

            if ($request->hasFile('addfile2')) {
                $file = $request->file('addfile2');
                $fileNameAddFile12 = time() . '.' . $file->getClientOriginalExtension();
               $file->move(public_path('upload'), $fileNameAddFile12);
            }

        $setData = [
            'customerName' => $request->customerName,
            'customerEmail' => $request->customerEmail,
            'customerPhone' => '',
            'customerTaxid' => $request->customerTaxid,
            'customerAddress' => $request->customerAddress,
            'totalAmount' => $request->totalAmount,
            'payment_status' => '0',
            'addfile1' => $fileNameAddFile1,
            'addfile2' => $fileNameAddFile2,
            'bookingID' => $bookingId
        ];

        if (empty($request->hinden_paymentid)) {
            // insert 
            $insert = payments::create($setData);
            if ($insert) {
                return response()->json([
                    'status' => 200
                ]);
            }
        } else {
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
        $class = new HelperService();
        $bookingId = $request->hinden_bookingID;
        $actionStatus = $request->chkStatus;

          $ResultBooking = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_rooms.id', $bookingId)
                ->get();


        // update Step  สถานะส่งต่อผู้บริหาร  :  Admin อนุมัติเอง 
        $isStatus = ($actionStatus == 'ForwardDean') ? 2 : 1;
        // เก็บประวัติการยกเลิกรายการจอง
        $isstatusCanceled = ($actionStatus == 'canceled') ? 1 : 0;
        // Message return 
        if ($actionStatus == 'ForwardDean') {
            $msg = " ส่งต่อให้ผู้บริหารพิจราณาเรียบร้อยแล้ว ";

            //ส่งต่อตามส่ายงาน
            $getEmailDean = DB::table('users')
                ->select('users.email')
                ->where('user_type', 'eng')
                ->get();

            if ($getEmailDean) {
                $setDataStep = [
                    'bookingID' => $bookingId,
                    'email' => $getEmailDean[0]->email,
                    'is_step' => 'eng'
                ];
                $result = stepappove::create($setDataStep);
                if ($result) {
                    $msg = "เรียนหัวหน้างานมีรายการขอใช้ห้องมาใหม่...";
                    $token = 'mMb96Ki0GrXKg21z4XARen0Hf32PL3imHuvOsxRFKCX';
                    $class->sendMessageTOline($token, $msg);
                }
            }

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
                    //ห้อง xxx ที่ท่านดูแล ได้อนุมัติใช้งาน เรื่อง "xxx" วัน xxx เวลา xxx จาก xxx (ดูตารางการใช้งานของห้อง xxx ที่ xxx)
                  /* $msgLine = " ห้อง".$ResultBooking[0]->roomFullName." ที่ท่านดูแลได้อนุมัติใช้งาน";              
                    $msgLine .= "เรื่อง:" .$ResultBooking[0]->booking_subject. "%0A";
                    $msgLine .= "วันที่:" .$ResultBooking[0]->schedule_startdate." เวลา ". $ResultBooking[0]->booking_time_start. "%0A";
                    $msgLine .= "จาก :" . $ResultBooking[0]->booking_booker."%0A";              
                    $msgLine .= "(จัดการ/ตรวจสอบการจองที่ E-roombook)";
                    // get Token  Admin 
                    $tokenUSer = $class->getlineTokenAdminRoom($ResultBooking[0]->roomID, 1);
                    if ($tokenUSer) {
                        // lop หากมี Admin หลายคน                
                        foreach ($tokenUSer as $admins) {
                            $class->sendMessageTOline($admins->lineToken, $msgLine);
                        }
                    }*/


                    //$class->sendMessageTOline('mMb96Ki0GrXKg21z4XARen0Hf32PL3imHuvOsxRFKCX', $msg);
                    // $listAdmin = $class->getlineTokenAdminRoom();            
                }
                return response()->json([
                    'status' => 200,
                    'message' => $msg,
                    'pagestatus' => $actionStatus
                ]);
            }
        }
    }

    public function setAuthPayment($bookingID)
    {
        $class = new HelperService();
        $ResultBooking = $this->getDetailByBookingID($bookingID);
        $engpaymentkey = $class->getAPIKEYPayment();
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
            CURLOPT_POSTFIELDS => '{
            "APIKEY": "' . $engpaymentkey . '",
            "customer_Name":"' . $ResultBooking[0]->customerName . '",
            "customer_Taxid":"' . $ResultBooking[0]->customerTaxid . '",
            "customer_Phone":"' . $ResultBooking[0]->customerPhone . '",
            "customer_Email":"' . $ResultBooking[0]->customerName . '",
            "customer_Address":"' . $ResultBooking[0]->customerAddress . '",
            "Amount":"' . $ResultBooking[0]->totalAmount . '",	
            "reUrl":"https://e-roombooking.eng.cmu.ac.th/paid"      
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        )
        );
        $response = curl_exec($curl);
        curl_close($curl);
        $callback_payment = json_decode($response, true);
        //echo print_r($callback_payment);
        //update LINK 
        $updated = DB::table('payments')->where('bookingID', $bookingID)
            ->update([
                'customerToken' => $callback_payment['customerToken'],
                'urlPayment' => $callback_payment['urlPayment']
            ]);

    }




}