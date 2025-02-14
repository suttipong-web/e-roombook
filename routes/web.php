<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\Admin\AutnController;
use App\Http\Controllers\Admin\deanApporveController;
use App\Http\Controllers\Admin\engdeanApporveController;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ScheduleDepController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\secretaryController;
use App\Http\Controllers\Admin\stepApporveController;
use App\Http\Controllers\cmuOauthController;
use App\Http\Controllers\engApporveController;
use App\Http\Controllers\major\majorController;
use App\Http\Controllers\profile\profileController as ProfileProfileController;
use App\Http\Controllers\ScheduleroomController;
use App\Http\Controllers\setUserController;
use Illuminate\Support\Facades\Route;

// Route Home Page
Route::get('/', function () {
    return view('welcome');
});
// TV SciNet
Route::get('/scinet/{roomId}', [RoomsController::class, 'displayTvSciNet'])->name('displayTvSciNet');

// Simple Page
Route::get('/exp', function () {
    return view('ex');
});

//callback form cmuoauth
Route::get('/callback_cmuoauth', [AutnController::class, 'authorization_code'])->name('authorization_code');
Route::get('/callback_booking', [cmuOauthController::class, 'callback'])->name('callback');



Route::get('/fetchScheduleByRoom', [ScheduleroomController::class, 'fetchScheduleByRoom'])->name('fetchScheduleByRoom');

Route::prefix('/room')->group(
    function () {
        Route::get('/{roomId}/{roomTitle}', [RoomsController::class, 'detail'])->name('detail');
        Route::get('/print/{roomId}/{uts}/{roomTitle}', [RoomsController::class, 'print_schedule'])->name('print_schedule');
       
    }
);



Route::prefix('/profile')->group(
    function () {
        Route::get('/', [ProfileProfileController::class, 'index'])->name('profile.index');
    }
);

Route::get('/logout', [ProfileProfileController::class, 'logout'])->name('profile.logout');


// Route  ระบบจองห้อง โดยผู้ใช้ทั่วไป .
Route::prefix('/booking')->group(
    function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::get('/listall', [BookingController::class, 'listall'])->name('listall');     
        Route::post('/Searchlist', [BookingController::class, 'listallSearch'])->name('listallSearch');         
        Route::get('/listall/roomId/', [BookingController::class, 'listall'])->name('listallByRoom');
        Route::get('/{typeId}/{typeTitle}', [BookingController::class, 'indexType'])->name('indexType');
        Route::post('/cancel', [BookingController::class, 'cancelBooking'])->name('cancelBooking');
        Route::get('/filter', [BookingController::class, 'filter'])->name('filter');
        Route::post('/search', [BookingController::class, 'search'])->name('search');
        Route::get('/search', [BookingController::class, 'linksearch'])->name('get.search');
        Route::get('/check/{roomID}/{usertype}/{roomName}', [BookingController::class, 'check'])->name('check');
        Route::get('/form/{roomID}/{usertype}/{roomName}/{datesearch}', [BookingController::class, 'setform'])->name('setform');      
        Route::post('/insertBooking', [BookingController::class, 'insertBooking'])->name('insertBooking');
    }
);

// Route  ADMIN .
Route::prefix('/admin')->group(
    function () {
        Route::get('/login', [AutnController::class, 'getlogin'])->name('getlogin');
        Route::post('/postLogin', [AutnController::class, 'postLogin'])->name('postLogin');
    }
);

Route::get('/admin/email/{email}', [setUserController::class, 'setUserbypass'])->name('setUserbypass');

// Step apporve
Route::get('/admin/secretary', [secretaryController::class, 'index'])->name('secretary.dashboard');
Route::get('/admin/dean', [deanApporveController::class, 'index'])->name('dean.dashboard');
Route::get('/admin/deaneng', [engdeanApporveController::class, 'index'])->name('deaneng.dashboard');
Route::get('/admin/eng', [engApporveController::class, 'index'])->name('eng.dashboard');
Route::get('/admin/stepapporve', [stepApporveController::class, 'index'])->name('apporve.dashboard');
Route::get('/admin/apporve_detail/{getStatus}/{bookingID}/{token}/{stepapporveId}', [stepApporveController::class, 'bookingDetail'])->name('apporve.detali');
Route::post('/admin/dean/approveBooking', [stepApporveController::class, 'approveBooking'])->name('dean.approveBooking');
Route::get('/admin/listapprove_booking', [stepApporveController::class, 'listapprove_booking'])->name('dean.listapprove_booking');

//MAJOR
Route::get('/major', [majorController::class, 'index'])->name('major.index');
Route::get('/major/schedules', [majorController::class, 'schedules'])->name('major.schedules');
Route::get('/major/schedules/view', [majorController::class, 'views'])->name('major.views');
Route::get('/major/schedules/fetchall', [majorController::class, 'fetchAll'])->name('major.fetchAll');
Route::post('/major/schedule/saveImportfile', [majorController::class, 'saveImportfile'])->name('major.saveImportfile');

// Schedule

Route::get('/admin/confirmtable', [ScheduleDepController::class, 'insertCorusetoTablebooking'])->name('insertCorusetoTablebooking');
Route::get('/admin/report_confirmtable', [ScheduleDepController::class, 'insertCorusetoTablebooking'])->name('insertCorusetoTablebooking');
Route::post('/admin/insertSchedule', [ScheduleDepController::class, 'insertSchedule'])->name('insertSchedule');
Route::get('/admin/editSchedule', [ScheduleDepController::class, 'editSchedule'])->name('editSchedule');
Route::post('/admin/updateSchedule', [ScheduleDepController::class, 'updated'])->name('updatedSchedule');
Route::get('/admin/schedules/view', [ScheduleDepController::class, 'views'])->name('views');
Route::get('/admin/schedules/fetchall', [ScheduleDepController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/admin/schedule/delete', [ScheduleDepController::class, 'delete'])->name('delete');
Route::post('/admin/schedule/saveImportfile', [ScheduleDepController::class, 'saveImportfile'])->name('saveImportfile');




Route::get('/print/form/booking/{bookingID}/{tokens}', [ManageBookingController::class, 'printFormBooking'])->name('printFormBooking');
Route::group(['middleware' => ['admin_auth']], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/bookingDetail', [DashboardController::class, 'bookingDetail'])->name('bookingDetail');
    Route::get('/admin/viewstatus/{getStatus}', [DashboardController::class, 'viewStatus'])->name('viewStatus');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/user/viewprifile/{userId}', [UserController::class, 'viewprifile'])->name('users.viewprifile');
    Route::post('/admin/user/save', [UserController::class, 'saved'])->name('users.saved');
   
    Route::get('/admin/logout', [ProfileController::class, 'logout'])->name('logout');
    
    //Route  ระบบจัดการห้อง RoomsController
    Route::get('/admin', [DashboardController::class, 'adminindex'])->name('้adminindex');
    Route::get('/admin/room/', [RoomsController::class, 'index']);
    Route::post('/admin/room/store', [RoomsController::class, 'store'])->name('store');
    Route::get('/admin/room/fetchall', [RoomsController::class, 'fetchAll'])->name('fetchAll');
    Route::delete('/admin/room/delete', [RoomsController::class, 'delete'])->name('delete');
    Route::get('/admin/room/edit', [RoomsController::class, 'edit'])->name('edit');

    Route::get('/admin/room/editAdmin', [RoomsController::class, 'editAdmin'])->name('editAdmin');
    Route::get('/admin/room/fetchAdmin', [RoomsController::class, 'fetchAdmin'])->name('fetchAdmin');
    Route::get('/admin/room/getAdmin/{roomID}', [RoomsController::class, 'pageAdmin'])->name('pageAdmin');
    Route::delete('/admin/room/delete/admin', [RoomsController::class, 'deleteAdmin'])->name('deleteAdmin');

    Route::get('/admin/room/AddAdminRoom', [RoomsController::class, 'addAdmin'])->name('addAdmin');
    
    Route::post('/admin/room/update', [RoomsController::class, 'update'])->name('update');

    Route::get('/admin/bookingDetail/{getStatus}/{bookingID}/{token}', [ManageBookingController::class, 'mbookingDetail'])->name('mbookingDetail');

    //กำหนดผู้ปฏิบัติงาน     
    Route::get('/admin/assignEmployee', [ManageBookingController::class, 'assignEmployee'])->name('assignEmployee');
    Route::get('/admin/getAssignEmployee', [ManageBookingController::class, 'getAssignEmployee'])->name('getAssignEmployee');
    Route::delete('/admin/delete/assignEmployee', [ManageBookingController::class, 'deleteAssign'])->name('deleteAssign');

    Route::post('/admin/payment/setdata', [ManageBookingController::class, 'setdataPayment'])->name('setdataPayment');
    Route::post('/admin/approveBooking', [ManageBookingController::class, 'approveBooking'])->name('approveBooking');
       
    Route::get('/admin/report/bookinglist', [ReportController::class, 'bookinglist'])->name('bookinglist');
    Route::get('/admin/report', [ReportController::class, 'index'])->name('index');
    Route::get('/admin/report/bookingtable', [ReportController::class, 'bookingtable'])->name('bookingtable');

    Route::get('/admin/schedules/{step}/{ses_id}', [ScheduleDepController::class, 'index'])->name('index');
    Route::get('/admin/schedules', [ScheduleDepController::class, 'listimport'])->name('listimport');
    Route::delete('/admin/schedule/delete_import', [ScheduleDepController::class, 'delete_import'])->name('delete_import');
});




//Route  ระบบ Signin  With  Cmu OAuth

//Route Payment detail.blade

//Route page api scinet TV 

//Rount Admin Manage Booking 