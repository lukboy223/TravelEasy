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
        DROP PROCEDURE IF EXISTS ReadUsers;
        CREATE PROCEDURE ReadUsers(
            IN givLIMIT int, 
            IN givOFFSET int)
            BEGIN
                SELECT USR.name as Username, ROL.name as RoleName, USR.created_at FROM users as USR
                inner join roles AS ROL
                on USR.id = ROL.user_id
                Order by USR.created_at DESC
                LIMIT givLIMIT OFFSET givOFFSET;
                END
                ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ReadUsers');
    }
};
