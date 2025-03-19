<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
      DROP PROCEDURE IF EXISTS SP_GetPeople;

CREATE PROCEDURE SP_GetPeople()
BEGIN
	SELECT 		 PPL.Id
				,PPL.Firstname
				,PPL.Infix
				,PPL.Lastname
				,PPL.Birthdate
				,PPL.Isactive
				,PPL.Note
				,PPL.DateCreated
				,PPL.DateChanged
                ,CUST.RelationNumber
                
	FROM 		people AS PPL
	INNER JOIN 	customers AS CUST
			ON 	CUST.PeopleId = PPL.Id;
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
