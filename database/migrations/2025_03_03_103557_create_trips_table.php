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
            $table->id();
            $table->integer('employee_id'); // medewerker_id
            $table->integer('departure_id'); // vertrek_id
            $table->integer('destination_id'); // bestemming_id
            $table->string('flight_number'); // vluchtnummer
            $table->date('departure_date'); // vertrekdatum
            $table->time('departure_time'); // vertrektijd
            $table->date('arrival_date'); // aankomstdatum
            $table->time('arrival_time'); // aankomsttijd
            $table->string('trip_status'); // reis_status
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
