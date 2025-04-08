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
        DROP PROCEDURE IF EXISTS UpdateBooking;
            CREATE PROCEDURE UpdateBooking(
                IN given_booking_id INT,
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
    UPDATE bookings
    SET
        customer_id = given_customer_id,
        trip_id = given_trip_id,
        seat_number = given_seat_number,
        purchase_date = given_purchase_date,
        purchase_time = given_purchase_time,
        price = given_price,
        quantity = given_quantity,
        booking_status = given_booking_status
    WHERE id = given_booking_id;
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
