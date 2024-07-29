<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminRooom extends Model
{
    use HasFactory;
    protected $fillable = [
        'cmuitaccount',
        'roomID',
        'phone',
        'adminroom_type_id'
    ];
}
