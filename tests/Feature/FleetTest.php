<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FleetTest extends TestCase
{
    use RefreshDatabase;
    public function test_fleet_crud()
    {
        // list
        $this->get('/fleets')->assertStatus(200)->assertSee('Daftar Armada');

        // create form
        $this->get('/fleets/create')->assertStatus(200)->assertSee('Tambah Armada');

        // store
        $response = $this->post('/fleets', [
            'number' => 'F100',
            'type' => 'Truck',
            'capacity' => 1000,
            'is_available' => 1
        ]);
        $response->assertRedirect('/fleets');
        $this->assertDatabaseHas('fleets', ['number' => 'F100']);

        $fleet = \App\Models\Fleet::where('number', 'F100')->first();

        // edit form
        $this->get("/fleets/{$fleet->id}/edit")
            ->assertStatus(200)->assertSee('Edit Armada');

        // update
        $this->put("/fleets/{$fleet->id}", [
            'number' => 'F100X',
            'type' => 'Van',
            'capacity' => 800,
            'is_available' => 0
        ])->assertRedirect('/fleets');
        $this->assertDatabaseHas('fleets', ['number' => 'F100X', 'type' => 'Van']);

        // delete
        $this->delete("/fleets/{$fleet->id}")
            ->assertRedirect('/fleets');
        $this->assertDatabaseMissing('fleets', ['number' => 'F100X']);
    }

}