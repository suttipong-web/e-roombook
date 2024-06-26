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
        'booking_AdminApprove',
        'booking_DeanApprove',
        'booking_cancel',
        'description',
        'booking_at',
        'booker_cmuaccount',
        'booking_food',
        'booking_camera',
        'booking_cancel',
        'booking_computer'

    ];
}
