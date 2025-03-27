<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS ReadBookings;
            CREATE PROCEDURE ReadBookings()
            BEGIN
                SELECT 
                bookings.*
                ,customers.relation_number 
                ,DEST.country as destination
                ,TRIP.FlightNumber
                FROM bookings

                INNER JOIN customers 
                ON bookings.customer_id = customers.id

                inner join Trips as TRIP
                on bookings.trip_id = TRIP.id

                inner join destinations as DEST
                on TRIP.destination_id = DEST.id
                ;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
