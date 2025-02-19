<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Zet model events uit
        WithoutModelEvents::class;

        // Maak 200 reizen aan
        \App\Models\Trip::factory(200)->create();
    }
}
