<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;
    public function test_booking_flow()
    {
        \App\Models\Fleet::factory()->create(['type' => 'Truck', 'is_available' => true]);

        $this->get('/bookings/create')
            ->assertStatus(200)->assertSee('Pemesanan Armada');

        $response = $this->post('/bookings', [
            'type' => 'Truck',
            'booking_date' => now()->addDay()->format('Y-m-d'),
            'origin' => 'Jakarta',
            'destination' => 'Surabaya',
            'goods_detail' => '5 karton beras',
        ]);
        $response->assertRedirect();
        $this->assertDatabaseCount('shipments', 1);
        $this->assertDatabaseCount('bookings', 1);
        $this->assertFalse(\App\Models\Fleet::first()->is_available);
    }


}