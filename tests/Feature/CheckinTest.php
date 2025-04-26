<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckinTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkin_and_map_view()
    {
        $fleet = \App\Models\Fleet::factory()->create();
        $this->get('/checkins/create')
            ->assertStatus(200)->assertSee('Check-In Armada');

        $this->post('/checkins', [
            'fleet_id' => $fleet->id,
            'latitude' => -7.75,
            'longitude' => 113.21
        ])->assertRedirect('/checkins');
        $this->assertDatabaseHas('checkins', ['fleet_id' => $fleet->id]);

        $this->get('/checkins')
            ->assertStatus(200)
            ->assertSee('id="map"');
    }

}