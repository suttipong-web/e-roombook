<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course_group extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_title'
    ];
}
