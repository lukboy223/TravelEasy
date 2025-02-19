<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trip;
use App\Models\Employee;
use App\Models\Location;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
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
            // Kies een willekeurige werknemer uit de database. Als er geen werknemer is, maak er dan een aan.
            'EmployeeId' => Employee::inRandomOrder()->first()->id ?? Employee::factory(),
            // Kies een willekeurige vertrek-locatie uit de database. Als er geen locatie is, maak er dan een aan.
            'DepartureId' => Location::inRandomOrder()->first()->id ?? Location::factory(),
            // Kies een willekeurige bestemmings-locatie uit de database. Als er geen locatie is, maak er dan een aan.
            'DestinationId' => Location::inRandomOrder()->first()->id ?? Location::factory(),
            // Genereer een willekeurig uniek vluchtnummer (bijv. "AB123" of "XY987").
            'FlightNumber' => $this->faker->unique()->bothify('??###'),
            // Genereer een willekeurige vertrekdatum.
            'DepartureDate' => $this->faker->date(),
            // Genereer een willekeurige vertrektijd.
            'DepartureTime' => $this->faker->time(),
            // Genereer een willekeurige aankomstdatum.
            'ArrivalDate' => $this->faker->date(),
            // Genereer een willekeurige aankomsttijd.
            'ArrivalTime' => $this->faker->time(),
            // Kies een willekeurige reisstatus uit de gegeven opties.
            'TravelStatus' => $this->faker->randomElement(['Gepland', 'Onderweg', 'Aangekomen', 'Geannuleerd']),
        ];
    }
}
