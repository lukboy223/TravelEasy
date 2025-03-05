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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id'); // Klant_id
            $table->integer('trip_id'); // Reis_id
            $table->string('destination'); // bestemming
            $table->string('seat_number'); // stoel_nummer
            $table->date('purchase_date'); // aankoopdatum
            $table->time('purchase_time'); // aankooptijd
            $table->decimal('price', 8, 2); // prijs
            $table->integer('quantity'); // aantal
            $table->string('booking_status'); // boeking_status
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
 