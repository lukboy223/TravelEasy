<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model
{
    /** @use HasFactory<\Database\Factories\TripFactory> */
    use HasFactory;

    protected $fillable = [
        'EmployeeId',
        'DepartureId',
        'DestinationId',
        'FlightNumber',
        'DepartureDate',
        'DepartureTime',
        'ArrivalDate',
        'ArrivalTime',
        'TravelStatus',
    ];

    // Relaties
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Zorg ervoor dat de datums in het gewenste formaat worden weergegeven
    public function getDepartureDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y'); // Formatteer als d-m-Y
    }

    public function getArrivalDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y'); // Formatteer als d-m-Y
    }
}
