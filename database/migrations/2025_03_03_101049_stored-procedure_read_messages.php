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
            ,CONCAT_WS(" ", CUS_PPL.firstname, CUS_PPL.infix, CUS_PPL.lastname) AS customer_fullname
            ,CONCAT_WS(" ", EMP_PPL.firstname, EMP_PPL.infix, EMP_PPL.lastname) AS employee_fullname
            ,TRI.FlightNumber as messagevluchtnumber
            FROM messages AS MSG

            INNER JOIN customers AS CUS
            ON MSG.Customer_id = CUS.id

            INNER JOIN people AS CUS_PPL
            ON CUS.people_id = CUS_PPL.id

            INNER JOIN employees AS EMP
            ON MSG.Employee_id = EMP.id

            INNER JOIN People AS EMP_PPL
            ON EMP.people_id = EMP_PPL.id

            INNER JOIN bookings AS BOOk
            ON BOOK.Customer_id = MSG.id

            INNER JOIN trips AS TRI
            ON TRI.Id = BOOK.Customer_id
            
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