<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS ReadInvoices;
        CREATE PROCEDURE ReadInvoices(
            IN givLIMIT INT, 
            IN givOFFSET INT
        )
        BEGIN
            SELECT 
                INV.id AS InvoiceID, 
                INV.InvoiceNumber, 
                INV.InvoiceDate, 
                INV.AmountExclVAT, 
                INV.VAT, 
                INV.AmountIncVAT, 
                INV.InvoiceStatus, 
                INV.IsActive, 
                INV.Note,
                BKG.id AS BookingID,
                PEO.Firstname, 
                PEO.Infix, 
                PEO.Lastname, 
                TRP.FlightNumber,
                TRP.DepartureDate,
                TRP.ArrivalDate
            FROM invoices AS INV
            INNER JOIN bookings AS BKG ON INV.BookingId = BKG.id
            INNER JOIN trips AS TRP ON BKG.TripId = TRP.id
            INNER JOIN customers AS CUS ON BKG.CustomerId = CUS.id
            INNER JOIN employees AS EMP ON TRP.EmployeeId = EMP.id
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
        DB::unprepared('DROP PROCEDURE IF EXISTS ReadInvoices');
    }
};
