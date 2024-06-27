<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\admin\AutnController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;


use Illuminate\Support\Facades\Route;
// Route Home Page
Route::get('/', function () {
    return view('welcome');
});




//Route  ระบบจัดการห้อง
Route::prefix('/room')->group(
    function () {
        Route::get('/', [RoomsController::class, 'index']);
        Route::post('/store', [RoomsController::class, 'store'])->name('store');
        Route::get('/fetchall', [RoomsController::class, 'fetchAll'])->name('fetchAll');
        Route::delete('/delete', [RoomsController::class, 'delete'])->name('delete');
        Route::get('/edit', [RoomsController::class, 'edit'])->name('edit');
        Route::post('/update', [RoomsController::class, 'update'])->name('update');
    }
);

// Route  ระบบจองห้อง.
Route::prefix('/booking')->group(
    function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::get('/filter', [BookingController::class, 'filter'])->name('filter');
        Route::post('/search', [BookingController::class, 'search'])->name('search');
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

//callback form cmuoauth
Route::get('/callback_cmuoauth', [AutnController::class, 'authorization_code'])->name('authorization_code');



Route::group(['middleware' => ['admin_auth']], function () {
    Route::get('/admin/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/logout', [ProfileController::class, 'logout'])->name('logout');
});




//Route  ระบบ Signin  With  Cmu OAuth

//Route Payment 

//Route page api scinet TV 

//Rount Admin Manage Booking 