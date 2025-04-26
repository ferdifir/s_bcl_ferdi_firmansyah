<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fleet;
use App\Models\Shipment;

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
    public function definition()
    {
        return [
            'fleet_id' => Fleet::factory(),
            'shipment_id' => Shipment::factory(),
            'booking_date' => now()->addDay(),
        ];
    }

}
