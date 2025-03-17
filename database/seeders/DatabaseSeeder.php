<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Role;
use App\Models\User;
use App\Models\Message;
use App\Models\Employee;
use App\Models\Person;
use App\Models\trip;
use Database\Factories\EmployeeFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(100)->create();
        Role::factory(100)->create();

        Message::factory(100)->create();
        Employee::factory(100)->create();
        trip::factory(100)->create();
        Booking::factory(100)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('cookie123'),
        ]);
    }
}
