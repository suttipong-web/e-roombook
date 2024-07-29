<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
        'cmuitaccount_name',
        'prename_TH',
        'firstname_TH',
        'lastname_TH',
        'itaccounttype_id',
        'itaccounttype_TH',
        'positionName',
        'positionName2',
        'isAdmin',
        'isDean',
        'dep_id',
        'last_activity',
        'typeposition_id',
        'dep_id',
        'lineToken',
        'is_step_secretary',
        'is_step_dean',
        'is_step_eng'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
