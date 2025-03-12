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
         DROP PROCEDURE IF EXISTS ReadRole;
        CREATE PROCEDURE ReadRole(
            IN UserId INT
        )
        BEGIN
            SELECT 
                Name
            FROM Roles
            WHERE User_id = UserId;
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
