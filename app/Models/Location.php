<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    use HasFactory;
    
    protected $fillable = [
        // Naam van de stad/luchthaven
        'Name',
        // Land
        'Country',
    ];

    public function departures()
    {
        return $this->hasMany(Trip::class, 'DepartureId');
    }

    public function destinations()
    {
        return $this->hasMany(Trip::class, 'DestinationId');
    }
}
