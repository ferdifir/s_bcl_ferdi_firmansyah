<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Shipment::create([
            'tracking_number' => 'SEED001',
            'shipped_at' => now(),
            'origin' => 'Bandung',
            'destination' => 'Semarang',
            'status' => 'pending',
            'goods_detail' => '10 dus kerupuk'
        ]);
    }

}
