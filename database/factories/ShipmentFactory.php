<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tracking_number' => strtoupper('TRK' . $this->faker->unique()->bothify('##??##')),
            'shipped_at' => now()->subDays(random_int(0, 5)),
            'origin' => $this->faker->city,
            'destination' => $this->faker->city,
            'status' => $this->faker->randomElement(['pending', 'in_transit', 'delivered']),
            'goods_detail' => $this->faker->sentence(6),
        ];
    }

}
