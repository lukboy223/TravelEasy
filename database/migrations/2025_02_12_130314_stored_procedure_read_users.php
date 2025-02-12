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
            CREATE PROCEDURE ReadUsers(
            IN givLIMIT int, 
            IN givOFFSET int)
            BEGIN
                SELECT * FROM users LIMIT givLIMIT OFFSET givOFFSET;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ReadUsers()');
    }
};
