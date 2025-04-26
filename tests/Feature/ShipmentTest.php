<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShipmentTest extends TestCase
{
    use RefreshDatabase;
    public function test_show_track_form()
    {
        $this->get('/track')
            ->assertStatus(200)
            ->assertSee('Track Shipment');
    }

    public function test_track_valid_shipment()
    {
        \App\Models\Shipment::factory()->create([
            'tracking_number' => 'TEST123',
            'origin' => 'Jakarta',
            'destination' => 'Surabaya',
            'status' => 'in_transit',
            'goods_detail' => 'Barang contoh',
            'shipped_at' => now(),
        ]);

        $this->post('/track', ['tracking_number' => 'TEST123'])
            ->assertStatus(200)
            ->assertSee('Shipment Details')
            ->assertSee('TEST123');
    }
}