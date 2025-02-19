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
