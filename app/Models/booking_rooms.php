<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_rooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_no',
        'roomID',
        'booking_date',
        'schedule_startdate',
        'schedule_enddate',
        'booking_time_start',
        'booking_time_finish',
        'booking_subject',
        'booking_subject_sec',
        'booking_Instructor',
        'booking_booker',
        'booking_ofPeople',
        'booking_department',
        'booking_autio',
        'booking_lcd',
        'booking_zoom',
        'bookingToken',
        'booking_status',
        'booking_type',
        'booking_status',
        'booking_AdminAction',
        'booking_DeanAction',
        'booking_cancel',
        'description',
        'booking_at',
        'booker_cmuaccount',
        'booking_food',
        'booking_camera',
        'booking_computer',
        'booking_email',
        'booking_phone',
        'admin_action_date',
        'dean_action_date',
        'admin_action_acount',
        'dean_action_acount',
        'booking_fileurl'
    ];
}
