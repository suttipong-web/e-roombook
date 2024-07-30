<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_ref1',
        'payment_ref2',
        'orderInv',
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
