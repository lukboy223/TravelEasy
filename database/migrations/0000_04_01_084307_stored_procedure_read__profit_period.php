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
        drop procedure if exists ReadProfitPeriod;
        Create procedure ReadProfitPeriod(
        In p_limit INT
        ,In p_offset INT
        )
        Begin
            Select
            sum(BOOK.Price) as TotalProfit
            ,DATE_FORMAT(Book.Purchase_date, "%Y-%m") as PurchaseMonth
            from bookings as BOOK
            group by DATE_FORMAT(Book.Purchase_date, "%Y-%m")
            order by PurchaseMonth desc;
        end
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
