<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Destination;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "FirstName" => $this->faker->firstName(),
            "Infix" => $this->faker->word(),
            "LastName" => $this->faker->lastName(),
            "DateOfBirth" => $this->faker->date(),
            "PassportDetails" => $this->faker->word(),
        ];
    }
}
