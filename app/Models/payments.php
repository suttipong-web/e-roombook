<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'customerToken',
        'urlPayment',
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
