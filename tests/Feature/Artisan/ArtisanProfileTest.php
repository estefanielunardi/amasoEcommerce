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

    private Artisan $artisan;
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['id' => 1, 'isArtisan' => true]));
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product = Product::factory()->create(['image' => null, 'name' => 'mermelada']);
    }
    public function testRouteArtisanProfile()
    {

        $response = $this->get('artisan/' . $this->artisan->slug);

        $response->assertStatus(200);
    }

    public function testReturnArtisanProfileView()
    {
        $response = $this->get('artisan/' . $this->artisan->slug);

        $response->assertViewIs('artisan.profileArtisan');
    }

    public function testReturnArtisanProfileViewWithData()
    {
        $response = $this->get('artisan/' . $this->artisan->slug);

        $response->assertViewIs('artisan.profileArtisan')
            ->assertViewHas('artisan')
            ->assertSee($this->artisan->name);
    }

    public function testReturnArtisanProfileViewHasProducts()
    {
        $response = $this->get('artisan/' . $this->artisan->slug);
        $response->assertViewIs('artisan.profileArtisan')
            ->assertViewHas('products');
    }
}
