<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Booking::factory()->count(30)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('cookie123'),
        ]);
    }
}
