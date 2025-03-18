<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'relation_number',
        'destination',
        'seat_number',
        'purchase_date',
        'purchase_time',
        'price',
        'quantity',
        'booking_status',
    ];
}
