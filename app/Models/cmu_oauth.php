<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cmu_oauth extends Model
{
    use HasFactory;
    protected $fillable = [
        'cmuitaccount',
        'prename_TH',
        'firstname_TH',
        'lastname_TH',
        'positionName',
        'positionName2',
        'isAdmin',
        'isDean',
        'password'
    ];
}
