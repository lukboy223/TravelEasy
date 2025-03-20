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
        DROP PROCEDURE IF EXISTS SP_CreateMessage;
        CREATE PROCEDURE SP_CreateMessage(
            IN p_customer_fullname VARCHAR(255),
            IN p_employee_fullname VARCHAR(255),
            IN p_vluchtnummer VARCHAR(255),
            IN p_bericht VARCHAR(255)
        )
        BEGIN
            DECLARE p_customer_id INT;
            DECLARE p_employee_id INT;
            DECLARE p_people_customer_id INT;
            DECLARE p_people_employee_id INT;
            DECLARE p_trip_id INT;

            SELECT id INTO p_people_customer_id FROM People WHERE FullName = p_customer_fullname;
            SELECT id INTO p_customer_id FROM customers WHERE people_id = p_people_customer_id;
               
            SELECT id INTO p_people_employee_id FROM People WHERE FullName = p_employee_fullname;
            SELECT id INTO p_employee_id FROM employees WHERE people_id = p_people_employee_id;

            select id INTO p_trip_id from trips where FlightNumber = p_vluchtnummer;
     
            INSERT INTO messages (customer_id, employee_id, message, trip_id, verzonden_datum , created_at, updated_at)
            VALUES (p_customer_id, p_employee_id, p_bericht, p_trip_id, now(6), now(6), now(6));
        END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_CreateMessage;');
    }
};
