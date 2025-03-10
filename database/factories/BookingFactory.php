<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Customer_id' => Customer::factory(),
            'trip_id' => Trip::factory(),
            'seat_number' => $this->faker->numberBetween(0, 200),
            'Purchase_date' => $this->faker->date(),
            'Purchase_time' => $this->faker->time(),
            'Price' => $this->faker->randomFloat(2, 0, 999999.99),
            'quantity' => $this->faker->randomNumber(),
            'Booking_status' => $this->faker->word,
        ];
    }
}
