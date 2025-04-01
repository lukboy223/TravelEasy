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
                ,DATE_FORMAT(Book.Purchase_date, "%Y-%m") as Purchase_date
                from bookings as Book
                group by DATE_FORMAT(Book.Purchase_date, "%Y-%m")
                order by DATE_FORMAT(Book.Purchase_date, "%Y-%m")
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
