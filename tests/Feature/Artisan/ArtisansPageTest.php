<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User;

class ArtisansPageTest extends TestCase
{
    use RefreshDatabase;

    private Artisan $artisan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['id' => 1, 'isArtisan' => true]));
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
    }
    public function testRoute()
    {
        $this->artisan;
        $response = $this->get('/artisans');

        $response->assertStatus(200);
    }

    public function testReturnArtisansView()
    {
        $this->artisan;
        $response = $this->get('/artisans');
        $response->assertViewIs('artisan.artisans');
    }

    public function testReturnArtisansViewWithArtisans()
    {
        $this->artisan;
        $response = $this->get('/artisans');

        $response->assertViewIs('artisan.artisans')
            ->assertViewHas('artisans');
    }
}
