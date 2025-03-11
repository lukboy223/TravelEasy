<?php

namespace Database\Factories;

use App\Models\customer;
use App\Models\employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "customerid" => customer::factory(),
            "employeeid" => employee::factory(),
            "bericht" => $this->faker->bericht(255),
            "verzonden_datum" => $this->faker->verzonden_datum(),
        ];
    }
}
