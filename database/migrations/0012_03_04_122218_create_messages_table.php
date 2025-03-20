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
        DROP TABLE IF EXISTS messages;
        CREATE TABLE messages (
            id int UNSIGNED AUTO_INCREMENT
            ,customer_id int UNSIGNED NOT NULL
            ,employee_id int UNSIGNED NOT NULL
            ,trip_id int UNSIGNED NULL
            ,Message varchar(255) NOT NULL
            ,verzonden_datum DATETIME NOT NULL
            ,isactief BIT DEFAULT TRUE
            ,opmerking varchar(255) NULL
            ,created_at datetime(6) not null default now(6)
            ,updated_at datetime(6) not null default now(6)
            ,PRIMARY KEY (id)
            ,FOREIGN KEY (customer_id) REFERENCES customers(id)
            ,FOREIGN KEY (employee_id) REFERENCES employees(id)
            ,FOREIGN KEY (trip_id) REFERENCES trips(id)
        )engine=InnoDB;        
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
