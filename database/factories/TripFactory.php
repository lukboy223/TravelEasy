<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Departure;
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
            'Employee_id' => Employee::factory(),
            'Departure_Id' => Departure::factory(),
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
