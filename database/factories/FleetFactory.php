<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fleet>
 */
class FleetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => 'FLEET-' . $this->faker->unique()->numerify('###'),
            'type' => $this->faker->randomElement(['Truck', 'Van', 'Pickup']),
            'capacity' => $this->faker->numberBetween(100, 2000),
            'is_available' => true,
        ];
    }

}
