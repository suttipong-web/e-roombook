<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roomSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'courseNO',
        'courseTitle',
        'courseSec',
        'Stdamount',
        'lecturer',
        'roomNo',
        'schedule_startdate',
        'schedule_enddate',
        'booking_time_start',
        'booking_time_finish',
        'terms',
        'courseofyear',
        'description',
        'is_confirm',
        'admin_confirm',
        'is_confirm_date',
        'admin_confirm_date',
        'roomID',
        'straff_account',
        'schedule_repeatday',
        'is_import_excel',
        'is_duplicate',
        'is_public',
        'is_public_date',
        'is_group_session',
        'is_error'
    ];
}