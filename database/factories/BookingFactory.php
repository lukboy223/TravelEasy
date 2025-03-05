<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(), // Klant_id
            'trip_id' => $this->faker->randomNumber(), // Klant_id
            'destination' => $this->faker->city, // bestemming
            'seat_number' => $this->faker->randomNumber(3), // stoel_nummer
            'purchase_date' => $this->faker->date, // aankoopdatum
            'purchase_time' => $this->faker->time, // aankooptijd
            'price' => $this->faker->randomFloat(2, 10, 100), // prijs
            'quantity' => $this->faker->numberBetween(1, 10), // aantal
            'booking_status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled']), // boeking_status
        ];
    }
}
