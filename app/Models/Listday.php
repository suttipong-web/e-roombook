<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listday extends Model
{
    use HasFactory;
    protected $fillable = [
            'dayTitle',
            'dayList',
            'numofday'
    ];
} 