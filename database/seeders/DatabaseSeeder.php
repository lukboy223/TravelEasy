<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Booking;
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
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('cookie123'),
        ]);
        Role::factory()->create([
            'name' => 'Administrator',
            'User_id' => 1,
        ]);
        Booking::factory(200)->create();
        
        Role::factory(100)->create();
    }
}
