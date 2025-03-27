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
            drop procedure if exists InsertBooking;
            CREATE PROCEDURE InsertBooking(
                IN customer_id INT,
                IN trip_id INT,
                IN seat_number VARCHAR(255),
                IN purchase_date DATE,
                IN purchase_time TIME,
                IN price DECIMAL(10, 2),
                IN quantity INT,
                IN booking_status VARCHAR(50)
            )
            BEGIN
                DECLARE relation_number INT;

                -- Get the relation_number from the customers table
                SELECT relation_number INTO relation_number
                FROM customers
                WHERE id = customer_id;

                -- Insert the new booking into the bookings table
                INSERT INTO bookings (
                    customer_id,
                    trip_id,
                    relation_number,
                    seat_number,
                    purchase_date,
                    purchase_time,
                    price,
                    quantity,
                    booking_status,
                    created_at,
                    updated_at
                ) VALUES (
                    customer_id,
                    trip_id,
                    relation_number,
                    seat_number,
                    purchase_date,
                    purchase_time,
                    price,
                    quantity,
                    booking_status,
                    NOW(),
                    NOW()
                );
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS InsertBooking');
    }
};
