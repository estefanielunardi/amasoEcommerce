<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\Product;

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
                ->assertViewHas('artisan')
                ->assertSee($artisan -> name); 
    }

    public function testReturnArtisanProfileViewHasProducts()
    {

        $artisan = Artisan::factory()->create(); 
        $products = Product::factory(3)->create([
            'artisan_id' => 1
        ]);

        $response = $this->get('artisan/' . $artisan->id);
        $response->assertViewIs('profileArtisan')
                ->assertViewHas('products');

    }

    public function testPaginateArtisanProducts() 
    {
        $artisan = Artisan::factory()->create(); 
        $products = Product::factory(3)->create([
            'artisan_id' => 1
        ]);

        $productOut = Product::factory()->create([
            'artisan_id' => 1,
            'name' => 'vino'
        ]);
        
        $response = $this->get('artisan/' . $artisan->id);
        $response->assertViewHas('products')
                ->assertViewMissing('productOut');
    }



}
