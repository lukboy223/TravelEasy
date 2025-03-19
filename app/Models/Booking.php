<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    /**
    * De tabelnaam van het model.
    *
    * @var string
    */
    // protected $table = 'bookings';
    
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'bookingId');
    }

}
