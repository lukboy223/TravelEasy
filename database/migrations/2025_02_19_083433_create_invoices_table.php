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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("BookingId");
            $table->string("InvoiceNumber");
            $table->date("InvoiceDate");
            $table->decimal("AmountExclVAT", 8, 2);
            $table->decimal("VAT", 8, 2);
            $table->decimal("AmountIncVAT", 8, 2);
            $table->string("InvoiceStatus");
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
        Schema::dropIfExists('invoices');
    }
};
