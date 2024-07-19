<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $getStatus = $request->getStatus;
        if ($request->bookingID) {
            $bookingId = $request->bookingID;
            $ResultBooking = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
                ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
                ->where('booking_rooms.id', $bookingId)
                ->get();
            return  view('admin.bookingDetail')->with([
                'detailBooking' => $ResultBooking,
                'getStatus' => $getStatus

            ]);
        }
    }
}
