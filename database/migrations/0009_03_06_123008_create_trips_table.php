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
        drop table if exists Trips;
        Create table Trips(
        Id int unsigned not null auto_increment
        ,Employee_id int unsigned not null 
        ,Departure_Id int unsigned not null 
        ,Destination_Id int unsigned not null 
        ,FlightNumber varchar(10) not null
        ,Departure_date date not null 
        ,Departure_time time not null 
        ,ArrivalDate date not null
        ,ArrivalTime time not null
        ,TripStatus varchar(50) not null
        ,Isactive bit not null default 1
        ,Note varchar(250) null default null
        ,Created_at datetime(6) not null default now(6)
        ,Updated_at datetime(6) not null default now(6)
        ,Primary Key (id)
              
        )engine=innoDB;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
