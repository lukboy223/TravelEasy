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
        DROP PROCEDURE IF EXISTS ReadUser;
        CREATE PROCEDURE ReadUser(
            IN givUserId int
            )
            BEGIN
                SELECT
                 USR.Id as UserId
                ,PPL.Id as PeopleId
                ,ROL.Id as RoleId
                ,PPL.FirstName as FirstName
                ,PPL.Infix as Infix
                ,PPL.LastName as LastName
                ,PPL.BirthDate as BirthDate
                ,USR.Email as Email
                ,USR.name as Username
                ,ROL.name as RoleName
                ,USR.created_at 
                FROM users as USR

                inner join roles AS ROL
                on USR.id = ROL.user_id

                inner join people AS PPL
                on USR.People_id = PPL.id

                where USR.id = givUserId;
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
