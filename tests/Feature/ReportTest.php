<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;
    public function test_in_transit_report()
    {
        $fleet = \App\Models\Fleet::factory()->create(['number' => 'F1']);
        $shipment = \App\Models\Shipment::factory()->create(['status' => 'in_transit']);
        \App\Models\Booking::factory()->create([
            'fleet_id' => $fleet->id,
            'shipment_id' => $shipment->id,
        ]);

        $this->get('/reports/in-transit')
            ->assertStatus(200)
            ->assertSee('F1')
            ->assertSee('1');
    }

}