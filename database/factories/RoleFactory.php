<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'User_id' => static::factoryForModel(User::class),
            'name' => $this->faker->randomElement(['Administrator', 'Medewerker', 'Klant', 'Gebruiker']),
        ];
    }
}
