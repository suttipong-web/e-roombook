<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use Illuminate\Http\Request;
use Session;
class profileController extends Controller
{
    public function index(Request $request){
        // Session Login
        $cmuitaccount = $request->session()->get('cmuitaccount');

         $ResultBooking = booking_rooms::join('rooms', 'rooms.id', '=', 'booking_rooms.roomID')
            ->select('booking_rooms.*', 'rooms.roomFullName', 'rooms.roomSize', 'rooms.roomDetail')
            ->where('booking_rooms.booking_type','eng')
            ->where('booking_rooms.booking_email', $cmuitaccount)
            ->get();

         return view('/profile/index')->with(
            [
                'getBookingList' => $ResultBooking
           
            ]

        );
    }

    public function logout(Request $request){

        // Invalidate the session
        $request->session()->invalidate();
        // Regenerate the CSRF token to prevent CSRF attacks
        $request->session()->regenerateToken();


        //  return redirect('/');
        return redirect()->away('https://login.microsoftonline.com/cf81f1df-de59-4c29-91da-a2dfd04aa751/oauth2/v2.0/logout?post_logout_redirect_uri=https://e-roombook.eng.cmu.ac.th');
    }   

}
