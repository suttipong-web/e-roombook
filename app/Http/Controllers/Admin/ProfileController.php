<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\booking_rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
                Session::forget('cmuitaccount');
                Session::forget('userfullname');
                Session::forget('isAdmin');
                Session::forget('user_type');
                Session::forget('userfullname');
                Session::flush();        
        //        return redirect()->intended('/admin/login')->with('success', 'You have been successfully logged out');
       // return redirect()->route('/admin/login/')->with('success', 'You have been successfully logged out');
         return redirect()->away('https://login.microsoftonline.com/cf81f1df-de59-4c29-91da-a2dfd04aa751/oauth2/v2.0/logout?post_logout_redirect_uri=https://e-roombook.eng.cmu.ac.th');
    }
}