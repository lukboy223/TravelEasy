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
        DROP PROCEDURE IF EXISTS CreateUser;
        CREATE PROCEDURE CreateUser(
            IN givFirstName varchar(50), 
            IN givInfix     varchar(10),
            IN givLastName  varchar(50),
            IN givBirthDate date,
            IN givEmail     varchar(150),
            IN givUsername  varchar(50),
            IN givPassword  varchar(255),
            IN givRole      varchar(50)
        )
        BEGIN
            DECLARE PersonId INT UNSIGNED DEFAULT 0;
            DECLARE UserId INT UNSIGNED DEFAULT 0;

            INSERT INTO people (FirstName, Infix, LastName, BirthDate, created_at)
            VALUES (givFirstName, givInfix, givLastName, givBirthDate, now(6));

            SET PersonId = LAST_INSERT_ID();

            INSERT INTO users (Person_Id, Email, Name, Password, created_at)
            VALUES (PersonId, givEmail, givUsername, givPassword, now(6));

            SET UserId = LAST_INSERT_ID();

            INSERT INTO roles (User_Id, Name, created_at)
            VALUES (UserId, givRole, now(6));
        END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS CreateUser');
    }
};
