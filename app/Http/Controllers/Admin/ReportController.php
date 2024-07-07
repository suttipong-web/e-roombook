<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        return view("admin.report.index");
    }
    public function bookinglist(Request $request)
    {
        $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_status', '<>', 0)
            ->get();
        return view("admin.report.report_bookinglist")->with([
            'getBookingList' => $ResultBookingNew
        ]);
    }
    public function bookingtable(Request $request)
    {
        return view("admin.report.report_bookingtable")->with([
            "s" => 'ssss'
        ]);
    }
}
