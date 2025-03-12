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
        DROP PROCEDURE IF EXISTS ReadBookingPeriod;
        CREATE PROCEDURE ReadBookingPeriod(
            IN givLIMIT int, 
            IN givOFFSET int)
            BEGIN
                SELECT 
                count(*) as total
                ,Purchase_date
                from bookings
                group by Purchase_date
                order by Purchase_date
                LIMIT givLIMIT OFFSET givOFFSET;
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
