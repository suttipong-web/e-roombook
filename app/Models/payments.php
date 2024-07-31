<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_ref1',
        'payment_ref2',
        'customerName',
        'customerEmail',
        'customerPhone',
        'organization',
        'customerTaxid',
        'customerAddress',
        'totalAmount',
        'payment_status',
        'is_confirm',
        'payment_date',
        'bookingID'
    ];
}
