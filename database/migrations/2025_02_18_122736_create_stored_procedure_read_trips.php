<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE PROCEDURE ReadTrips(
                IN givLIMIT INT, 
                IN givOFFSET INT
            )
            BEGIN
                SELECT 
                    TRP.id as TripID, 
                    TRP.FlightNumber, 
                    TRP.DepartureDate, 
                    TRP.DepartureTime, 
                    TRP.ArrivalDate, 
                    TRP.ArrivalTime, 
                    TRP.TravelStatus, 
                    TRP.IsActive, 
                    TRP.Note,
                    PEO.Firstname, 
                    PEO.Infix, 
                    PEO.Lastname, 
                    DEP.Country as DepartureCountry, 
                    DEST.Country as DestinationCountry
                FROM trips AS TRP
                INNER JOIN employees AS EMP ON TRP.EmployeeId = EMP.id
                INNER JOIN departures AS DEP ON TRP.DepartureId = DEP.id
                INNER JOIN destinations AS DEST ON TRP.DestinationId = DEST.id
                INNER JOIN people AS PEO ON EMP.PersonId = PEO.id
                LIMIT givLIMIT OFFSET givOFFSET;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ReadTrips');
    }
};
