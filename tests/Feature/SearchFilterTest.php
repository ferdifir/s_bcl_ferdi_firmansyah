<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;
    public function test_shipment_search()
    {
        \App\Models\Shipment::factory()->create(['destination' => 'Semarang']);
        \App\Models\Shipment::factory()->create(['destination' => 'Surabaya']);
        $this->get('/shipments?q=Surabaya')
            ->assertStatus(200)
            ->assertSee('Surabaya')
            ->assertDontSee('Semarang');
    }

    public function test_fleet_filter()
    {
        \App\Models\Fleet::factory()->create(['type' => 'Van', 'is_available' => true]);
        \App\Models\Fleet::factory()->create(['type' => 'Truck', 'is_available' => false]);
        $this->get('/fleets?type=Van&availability=available')
            ->assertStatus(200)
            ->assertSee('Van')
            ->assertDontSee('Truck');
    }

}