<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    protected $fillable = [
        'roomToken',
        'roomFullName',
        'roomTitle',
        'roomSize',
        'roomTypeId',
        'placeId',
        'thumbnail',
        'roomDetail',
        'is_open',
        'is_status'   ];  
}
