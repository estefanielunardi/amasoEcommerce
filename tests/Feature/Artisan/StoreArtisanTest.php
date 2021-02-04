<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class StoreArtisanTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreArtisan()
    {
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        $artisan = [
            'name' => 'Pepita',
            'location' => 'Tarragona',
            'description' => 'sfxghrsf',
        ];

        $response = $this->post(route('artisanStore', $artisan));

        $this->assertDatabaseCount('artisans', 1)
            ->assertDatabaseHas('artisans', ['name' => 'Pepita']);

        $response->assertViewIs('admin.responsesAdmin');
    }
}
