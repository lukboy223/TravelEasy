<?php

namespace Database\Seeders;

use App\Models\Departure;
use App\Models\Destination;
use App\Models\Employee;
use App\Models\Trip;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Trip::factory(200)->create();
        Departure::factory(200)->create();
        Destination::factory(200)->create();
        Employee::factory(200)->create();
    }
}
