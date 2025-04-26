<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fleet;

class FleetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fleets = [
            [
                'number' => 'FLEET001',
                'type' => 'Truck',
                'capacity' => 1000,
                'is_available' => true,
            ],
            [
                'number' => 'FLEET002',
                'type' => 'Van',
                'capacity' => 500,
                'is_available' => true,
            ],
            [
                'number' => 'FLEET003',
                'type' => 'Pickup',
                'capacity' => 300,
                'is_available' => false,
            ],
            [
                'number' => 'FLEET004',
                'type' => 'Container',
                'capacity' => 2000,
                'is_available' => true,
            ],
        ];

        foreach ($fleets as $data) {
            Fleet::create($data);
        }
    }
}
