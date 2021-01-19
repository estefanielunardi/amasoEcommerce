<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;

class ArtisanProfileTest extends TestCase
{
    use RefreshDatabase; 
    public function testRouteArtisanProfile()
    {
        $artisan = Artisan::factory()->create(); 

        $this->withoutExceptionHandling();
        $response = $this->get('artisan/' . $artisan->id);

        $response->assertStatus(200);
    }

    public function testReturnArtisanProfileView()
    {
        $artisan = Artisan::factory()->create(); 

        $this->withoutExceptionHandling();
        $response = $this->get('artisan/' . $artisan->id);

        $response->assertViewIs('profileArtisan');
    }

    public function testReturnArtisanProfileViewWithData()
    {
        $artisan = Artisan::factory()->create(); 

        $this->withoutExceptionHandling();
        $response = $this->get('artisan/' . $artisan->id);

        $response->assertViewIs('profileArtisan')
                ->assertViewHas('artisan');
    }
}
