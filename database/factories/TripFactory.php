<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Employee_id' => $this->faker->randomNumber(5),
            'Departure_Id' =>  $this->faker->randomNumber(5),
            'Destination_Id' => Destination::factory(),
            'FlightNumber' => $this->faker->numberBetween(100000, 999999),
            'Departure_date' => $this->faker->date(),
            'Departure_time' => $this->faker->time(),
            'ArrivalDate' => $this->faker->date(),
            'ArrivalTime' => $this->faker->time(),
            'TripStatus' => $this->faker->word,
        ];
    }
}
