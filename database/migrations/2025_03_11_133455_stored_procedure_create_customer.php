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
   DROP PROCEDURE IF EXISTS SP_create_customer;
CREATE PROCEDURE SP_create_customer(
IN givLIMIT int
,IN givOFFSET int)
BEGIN



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
