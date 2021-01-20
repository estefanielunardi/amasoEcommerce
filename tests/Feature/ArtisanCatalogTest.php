<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;

class ArtisanCatalogTest extends TestCase
{
    use RefreshDatabase;
    public function test_route()
    {   
        $artisan = Artisan::factory()->create(); 
        $this->withoutExceptionHandling();
        $response = $this->get('/artisan/products' . $artisan->id);

        $response->assertStatus(200);
    }

    public function test_view_is_profile_artisan()
    {
        $artisan = Artisan::factory()->create(); 
        $this->withoutExceptionHandling();
        $response = $this->get('/artisan/products' . $artisan->id);

        $response->assertViewIs('profileArtisan')
                 ->assertViewHas('products');

    }

}
