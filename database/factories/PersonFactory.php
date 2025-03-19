<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'Firstname' => $this->faker->Firstname,
            'Infix' => $this->faker->optional()->Lastname,
            'Lastname' => $this->faker->Lastname,
            'Birthdate' => $this->faker->date,
            'Isactive' => $this->faker->boolean,
            'Note' => $this->faker->text,
            'DateCreated' => $this->faker->dateTime,
            'DateChanged' => $this->faker->dateTime,
        ];
    }
}
