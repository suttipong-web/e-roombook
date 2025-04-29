<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jop_booking extends Model
{
    protected $table = 'jop_booking';
    use HasFactory;
    protected $fillable = [
            'chkroom',
            'datestart',
            'endstart'
    ];
} 