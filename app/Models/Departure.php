<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Departure extends Model
{
    /** @use HasFactory<\Database\Factories\DepartureFactory> */
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];  
}
