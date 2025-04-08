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
        DROP PROCEDURE IF EXISTS CreateBooking;
            CREATE PROCEDURE CreateBooking(
                IN given_customer_id INT,
                IN given_trip_id INT,
                IN given_seat_number VARCHAR(10),
                IN given_purchase_date DATE,
                IN given_purchase_time TIME,
                IN given_price DECIMAL(8, 2),
                IN given_quantity INT,
                IN given_booking_status VARCHAR(50)
            )
            BEGIN
                INSERT INTO bookings (customer_id, trip_id, seat_number, purchase_date, purchase_time, price, quantity, booking_status)
                VALUES (given_customer_id, given_trip_id, given_seat_number, given_purchase_date, given_purchase_time, given_price, given_quantity, given_booking_status);
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
