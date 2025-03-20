<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\models\Person;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'PeopleId' => Person::factory(),
            'RelationNumber' => $this->faker->numberBetween(1, 1000),
            'Isactive' => $this->faker->boolean,
            'Note' => $this->faker->text,
            'DateCreated' => $this->faker->dateTime,
            'DateChanged' => $this->faker->dateTime,
        ];
    }
}
