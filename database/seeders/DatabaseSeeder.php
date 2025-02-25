<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Departure;
use App\Models\Destination;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Location;
use App\Models\Person;
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
            'password' => bcrypt('password'),
        ]);

        Trip::factory(200)->create();
        Departure::factory(200)->create();
        Destination::factory(200)->create();
        Employee::factory(200)->create();
        Customer::factory(200)->create();
        Booking::factory(200)->create();
        Invoice::factory(200)->create();
        Person::factory(200)->create();
        Location::factory(200)->create();
    }
}
