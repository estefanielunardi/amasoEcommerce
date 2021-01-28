<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\Product;
use App\Models\User;

class ArtisanProfileTest extends TestCase
{
    use RefreshDatabase; 
    public function testRouteArtisanProfile()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        $this->withoutExceptionHandling();
        $response = $this->get('artisan/' . $artisan->slug);

        $response->assertStatus(200);
    }

    public function testReturnArtisanProfileView()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);

        $this->withoutExceptionHandling();
        $response = $this->get('artisan/' . $artisan->slug);

        $response->assertViewIs('profileArtisan');
    }

    public function testReturnArtisanProfileViewWithData()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);

        $this->withoutExceptionHandling();
        $response = $this->get('artisan/' . $artisan->slug);

        $response->assertViewIs('profileArtisan')
                ->assertViewHas('artisan')
                ->assertSee($artisan -> name); 
    }

    public function testReturnArtisanProfileViewHasProducts()
    {

        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        Product::factory(3)->create([
            'artisan_id' => 1
        ]);

        $response = $this->get('artisan/' . $artisan->slug);
        $response->assertViewIs('profileArtisan')
                ->assertViewHas('products');
    }

}
