<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = "";
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
        }

        $ResultBookingNew = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_AdminApprove', 0)
            ->get();

        return view('admin.dashboard')->with([
            'title' => 'Dashboard',
            'sessionUser' => $user,
            'getBookingList' => $ResultBookingNew
        ]);

    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out');
    }
}
