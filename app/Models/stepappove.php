<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stepappove extends Model
{
    use HasFactory;
     protected $fillable = [
        'bookingID',
        'email',
        'is_step',
        'is_status',
        'action_date',
        'is_read'
     ];
}