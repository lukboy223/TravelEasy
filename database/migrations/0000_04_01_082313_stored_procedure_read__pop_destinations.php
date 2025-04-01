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
        DROP PROCEDURE IF EXISTS ReadPopularDestinations;
            CREATE PROCEDURE ReadPopularDestinations(
            IN p_limit INT
            ,IN p_offset INT
            )
            BEGIN
            
                Select
                count(BOOK.id) as TripCount
                ,DEST.Country as Destination

                from bookings as BOOK
                join trips as TRIP on BOOK.Trip_id = TRIP.id
                join destinations as DEST on TRIP.Destination_id = DEST.id
                group by DEST.Country
                order by TripCount desc
                limit p_limit offset p_offset;


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
