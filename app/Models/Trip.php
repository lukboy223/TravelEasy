<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /** @use HasFactory<\Database\Factories\TripFactory> */
    use HasFactory;

    protected $fillable = [
        // ID van de werknemer die de reis maakt
        'EmployeeId',
        // ID van de vertrekplaats
        'DepartureId',
         // ID van de bestemming
        'DestinationId',
        // Vluchtnummer van de reis
        'FlightNumber',
         // Datum van vertrek
        'DepartureDate',
        // Tijd van vertrek
        'DepartureTime',
        // Datum van aankomst
        'ArrivalDate',
        // Tijd van aankomst
        'ArrivalTime',
        // Status van de reis (bijv. gepland, onderweg, voltooid)
        'TravelStatus',
    ];

    // Zorg ervoor dat de datums correct worden weergegeven
    public function getDepartureDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y'); // Pas aan naar je gewenste formaat
    }

    public function getArrivalDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y'); // Pas aan naar je gewenste formaat
    }


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

}
