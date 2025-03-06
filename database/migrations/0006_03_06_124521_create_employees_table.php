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
        drop table if exists Employees;
        Create table Employees(
        Id int unsigned not null auto_increment
        ,People_id int unsigned not null 
        ,Number varchar(10) not null
        ,EmployeeType varchar(50) not null
        ,Isactive bit not null default 1
        ,Note varchar(250) null default null
        ,Created_at datetime(6) not null default now(6)
        ,Updated_at datetime(6) not null default now(6)
        ,Primary Key (id)   
        ,Foreign Key (People_id) references People(Id) 
        )engine=innoDB;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_employees');
    }
};
