<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Booking::factory()->count(30)->create();
    }
}