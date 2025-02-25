<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\Invoice;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'BookingId' => Booking::inRandomOrder()->first()->id ?? Booking::factory(),
            'InvoiceNumber' => $this->faker->bothify('##??##'),
            'InvoiceDate' => $this->faker->date(),
            'AmountExclVAT' => $this->faker->randomFloat(2, 10, 1000),
            'VAT' => $this->faker->randomFloat(2, 1, 21),
            'AmountIncVAT' => $this->faker->randomFloat(2, 10, 1000),
            'InvoiceStatus' => $this->faker->randomElement(['Betaald', 'Niet betaald', 'Geannuleerd']),	
        ];
    }
}
