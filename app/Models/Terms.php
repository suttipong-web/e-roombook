<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'year',
        'is_status',
        'start_date',
        'end_date',
        'is_status',
        'action_detail',
        'group1_start',
        'group1_end',
        'group2_start',
        'group2_end',
        'group3_start',
        'group3_end'        
     ];
}
