<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS ReadMessages;
        CREATE PROCEDURE ReadMessages(
            IN givLIMIT int, 
            IN givOFFSET int
        )
        BEGIN
            SELECT 
            MSG.id as MessageID
            ,MSG.verzonden_datum as messageverzendatum
            ,MSG.bericht as message
            ,CONCAT_WS(" ", PPL.firstname, PPL.infix, PPL.lastname) AS customer_fullname
            ,CONCAT_WS(" ", PPL.firstname, PPL.infix, PPL.lastname) AS employee_fullname
            ,TRI.FlightNumber as messagevluchtnumber
            
            FROM messages AS MSG

             INNER JOIN customers AS CUS
					ON CUS.id = MSG.Customer_id 

             INNER JOIN people AS PPL
					ON PPL.id = CUS.people_id

             INNER JOIN employees AS EMP
 					ON EMP.id = MSG.employee_id

             LEFT JOIN bookings AS BOOk
 					ON BOOK.Customer_id = CUS.id

             LEFT JOIN trips AS TRI
					ON TRI.Id = BOOK.trip_id

            LIMIT givLIMIT OFFSET givOFFSET;
        END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ReadMessages;');
    }
};