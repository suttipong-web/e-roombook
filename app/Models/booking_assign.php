<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_assign extends Model
{
    use HasFactory;
    protected $fillable = [
        'cmuitaccount',
        'bookingID',
        'is_read',
        'is_send_email',
        'is_send_line',
        'is_confirm'
    ];
}
