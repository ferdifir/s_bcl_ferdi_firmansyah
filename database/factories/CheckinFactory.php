<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fleet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checkin>
 */
class CheckinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fleet_id' => Fleet::factory(),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }

}
