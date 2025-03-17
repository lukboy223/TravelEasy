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
            IN p_customer_id INT,
            IN p_employee_id INT,
            IN p_vluchtnummer VARCHAR(255),
            IN p_bericht VARCHAR(255)
        )
        BEGIN
        declare Message_id INT;

            INSERT INTO messages (customer_id, employee_id, bericht, created_at)
            VALUES (p_customer_id, p_employee_id, p_bericht now(6));

            SET Message_id = select trip_id from trips where vluchtnummer = p_vluchtnummer;
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
