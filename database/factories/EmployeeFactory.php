<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "peopleid" => Person::factory(),
            "nummer" => $this->faker->nummer(255),
            "medewerkertype" => $this->faker->randomElement(["Manager", "Beheerder", "Diskmedewerker"]),
        ];
    }
}
