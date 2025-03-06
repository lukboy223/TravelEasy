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
        drop table if exists Bookings;
        Create table Bookings(
        Id int unsigned not null auto_increment
        ,Customer_id int unsigned not null 
        ,trip_id int unsigned not null 
        ,seat_number varchar(10) not null
        ,Purchase_date date not null
        ,Purchase_time time not null 
        ,Price decimal(10,2) not null
        ,quantity int unsigned not null
        ,Booking_status varchar(50) not null
        ,Isactive bit not null default 1
        ,Note varchar(250) null default null
        ,Created_at datetime(6) not null default now(6)
        ,Updated_at datetime(6) not null default now(6)
        ,Primary Key (id)
        ,Foreign Key (Customer_id) references Customers(Id)
        ,Foreign Key (trip_id) references Trips(Id)       
        )engine=innoDB;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
