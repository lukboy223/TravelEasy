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
        // Create the stored procedure
        DB::unprepared('
            DROP PROCEDURE IF EXISTS DeleteUser;
            CREATE PROCEDURE DeleteUser(IN userId INT)
            BEGIN
                declare PeopleId int default 0;
                declare RoleId int default 0;

                select People_id into PeopleId from users where id = userId;
                select id into RoleId from Roles where User_id = userId;

                Delete from People where id = PeopleId;
                Delete from roles where id = RoleId;
                DELETE FROM users WHERE id = userId;
            END
        ');

        // Optionally, you can add a message to indicate the procedure was created successfully
        echo "Stored procedure DeleteUser created successfully.";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
