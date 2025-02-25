<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\Trip;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
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
            'CustomerId' => Customer::inRandomOrder()->first()->id ?? Customer::factory(),
            'TripId' => Trip::inRandomOrder()->first()->id ?? Trip::factory(),
            'SeatNumber' => $this->faker->bothify('??#'),
            'PurchaseDate' => $this->faker->date(),
            'PurchaseTime' => $this->faker->time(),
            'BookingStatus' => $this->faker->randomElement(['Geboekt', 'Betaald', 'Geannuleerd']),
            'Price' => $this->faker->randomFloat(2, 10, 1000),
            'Number' => $this->faker->numberBetween(1, 10),
            'SpecialRequests' => $this->faker->text(),
        ];
    }
}
