<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
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
            "PersonId" => static::factoryForModel(Person::class),
            "Number" => $this->faker->unique()->randomNumber(5),
            "EmployeeType" => $this->faker->randomElement(["Manager", "Administrator", "DiskEmployee"]),
        ];
    }
}
