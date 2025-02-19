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
        Schema::create('trips', function (Blueprint $table) {
            // primary key (ID)
            $table->id();
            // medewerker id, vertrek id
            $table->unsignedBigInteger("EmployeeId");
            // vertrek id
            $table->unsignedBigInteger("DepartureId");
            // bestemming id
            $table->unsignedBigInteger("DestinationId");
            // vluchtnummer
            $table->string("FlightNumber")->unique();
            // vertrekdatum
            $table->date("DepartureDate");
            //, vertrektijd, aankomstdatum, aankomsttijd, reisstatus, actief, notitie
            $table->time("DepartureTime");
            // aankomstdatum
            $table->date("ArrivalDate");
            // aankomsttijd
            $table->time("ArrivalTime");
            // reisstatus
            $table->string("TravelStatus"); // Optioneel: enum mogelijk
            // actief
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
        Schema::dropIfExists('trips');
    }
};
