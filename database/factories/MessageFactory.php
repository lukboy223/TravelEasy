<?php

namespace Database\Factories;

use App\Models\customer;
use App\Models\employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "customer_id" => customer::factory(),
            "employee_id" => employee::factory(),
            "bericht" => $this->faker->text(255),
            "verzonden_datum" => $this->faker->date(),
        ];
    }
}
