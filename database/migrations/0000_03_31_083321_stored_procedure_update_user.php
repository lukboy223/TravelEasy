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
        DROP PROCEDURE IF EXISTS UpdateUser;
        CREATE PROCEDURE UpdateUser(
            IN givFirstName varchar(50), 
            IN givInfix     varchar(10),
            IN givLastName  varchar(50),
            IN givBirthDate date,
            IN givEmail     varchar(150),
            IN givUsername  varchar(50),
            IN givRole      varchar(50),
            IN PeopleId INT UNSIGNED,
            IN UserId INT UNSIGNED,
            IN RoleId INT UNSIGNED
        )
        BEGIN
            
        update People set 
        FirstName = givFirstName,
        Infix = givInfix,
        LastName = givLastName,
        BirthDate = givBirthDate
        where Id = PeopleId;

        update Users set
        Email = givEmail,
        Name = givUsername
        where Id = UserId;

        update Roles set
        Name = givRole
        where Id = RoleId;

           
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
