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
            $table->unsignedBigInteger("CustomerId");
            $table->unsignedBigInteger("TravelId");
            $table->string("SeatNumber");
            $table->date("PurchaseDate");
            $table->time("PurchaseTime");
            $table->string("BookingStatus");
            $table->decimal("Price", 8, 2);
            $table->integer("Number");
            $table->text("SpecialRequests");
            $table->boolean("IsActive")->default(true);
            $table->text('Note')->nullable(); // Eventuele opmerkingen, kan leeg zijn
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
