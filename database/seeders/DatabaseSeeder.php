<?php

namespace Database\Seeders;


use App\Models\Customer;
use App\Models\Person;
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
        

        if (!User::where('email', 'test@test.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => bcrypt('password'),
            ]);
        }
        
        User::factory(10)->create();
        Person::factory(30)->create();
        Customer::factory(30)->create();

    }

}
