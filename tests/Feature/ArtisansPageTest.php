<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;

class ArtisansPageTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/artisans');

        $response->assertStatus(200);
    }

    public function testReturnArtisansView()
    {
        $response = $this->get('/artisans');
        $response->assertViewIs('artisans');
    }

    public function testReturnArtisansViewWithArtisans()
    {
        Artisan::factory()->create();

        $response = $this->get('/artisans');

        $response->assertViewIs('artisans')
                ->assertViewHas('artisans');
    }

    public function testPagination()
    {
        Artisan::factory(6)->create();
        $artisanOutPage = Artisan::factory()->create();

        $response = $this->get('/artisans');

        $response->assertViewIs('artisans')
                ->assertViewHas('artisans')
                ->assertViewMissing('artisanOutPage');
    }
}
