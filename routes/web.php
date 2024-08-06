<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\Admin\AutnController;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ScheduleDepController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\secretaryController;
use App\Http\Controllers\cmuOauthController;
use App\Http\Controllers\ScheduleroomController;
use App\Http\Controllers\setUserController;
use Illuminate\Support\Facades\Route;

// Route Home Page
Route::get('/', function () {
    return view('welcome');
});
//callback form cmuoauth
Route::get('/callback_cmuoauth', [AutnController::class, 'authorization_code'])->name('authorization_code');
Route::get('/callback_booking', [cmuOauthController::class, 'callback'])->name('callback');


Route::get('/fetchScheduleByRoom', [ScheduleroomController::class, 'fetchScheduleByRoom'])->name('fetchScheduleByRoom');

Route::prefix('/room')->group(
    function () {
        Route::get('/{roomId}/{roomTitle}', [RoomsController::class, 'detail'])->name('detail');
    }
);


// Route  ระบบจองห้อง โดยผู้ใช้ทั่วไป .
Route::prefix('/booking')->group(
    function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::get('/filter', [BookingController::class, 'filter'])->name('filter');
        Route::post('/search', [BookingController::class, 'search'])->name('search');
        Route::get('/check/{roomID}/{usertype}/{roomName}', [BookingController::class, 'check'])->name('check');
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

Route::get('/admin/secretary', [secretaryController::class, 'index'])->name('secretary.dashboard');

Route::get('/print/form/booking/{bookingID}/{tokens}', [ManageBookingController::class, 'printFormBooking'])->name('printFormBooking');

Route::group(['middleware' => ['admin_auth']], function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/bookingDetail', [DashboardController::class, 'bookingDetail'])->name('bookingDetail');
    Route::get('/admin/viewstatus/{getStatus}', [DashboardController::class, 'viewStatus'])->name('viewStatus');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
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

    Route::get('/admin/schedules', [ScheduleDepController::class, 'index'])->name('index');
    Route::post('/admin/insertSchedule', [ScheduleDepController::class, 'insertSchedule'])->name('insertSchedule');
    Route::get('/admin/editSchedule', [ScheduleDepController::class, 'editSchedule'])->name('editSchedule');
    Route::post('/admin/updateSchedule', [ScheduleDepController::class, 'updated'])->name('updatedSchedule');
    Route::get('/admin/schedules/view', [ScheduleDepController::class, 'views'])->name('views');
    Route::get('/admin/schedules/fetchall', [ScheduleDepController::class, 'fetchAll'])->name('fetchAll');
    Route::delete('/admin/schedule/delete', [ScheduleDepController::class, 'delete'])->name('delete');
    Route::post('/admin/schedule/saveImportfile', [ScheduleDepController::class, 'saveImportfile'])->name('saveImportfile');
});




//Route  ระบบ Signin  With  Cmu OAuth

//Route Payment 

//Route page api scinet TV 

//Rount Admin Manage Booking 