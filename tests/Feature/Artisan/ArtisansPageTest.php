<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User;

class ArtisansPageTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        $response = $this->get('/artisans');

        $response->assertStatus(200);
    }

    public function testReturnArtisansView()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);

        $response = $this->get('/artisans');
        $response->assertViewIs('artisans');
    }

    public function testReturnArtisansViewWithArtisans()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);

        $response = $this->get('/artisans');

        $response->assertViewIs('artisans')
                ->assertViewHas('artisans');
    }
}