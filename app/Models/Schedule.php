<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'courseNO',
        'courseTitle',
        'courseSec',
        'amount',
        'onDays',
        'onTimes',
        'roomNo',
        'lecturer',
        'description',
        'is_confirm',
        'admin_confirm',
        'is_confirm_date',
        'admin_confirm_date',
        'roomID'
    ];
}
