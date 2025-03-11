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
        DROP TABLE IF EXISTS customers;
        CREATE TABLE customers (
            id int UNSIGNED AUTO_INCREMENT
            ,people_id int UNSIGNED NOT NULL
            ,relatienummer VARCHAR(255) NOT NULL
            ,isactief bit DEFAULT TRUE
            ,opmerking VARCHAR(255) NULL
            ,created_at datetime(6) not null default now(6)
            ,updated_at datetime(6) not null default now(6)
            ,PRIMARY KEY (id)
            ,FOREIGN KEY (people_id) REFERENCES people(id)
        )engine=InnoDB;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
