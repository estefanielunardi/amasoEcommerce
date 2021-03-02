<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;

class RattingsTest extends TestCase
{
    use RefreshDatabase;
    private Product $product;
    
    protected function setUp(): void
     {
        parent::setUp();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        $this->alfredo = User::factory()->create(['name' => 'Alfredo', 'email' => 'alfredo@alfredo', 'password' => '12345678']);
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product = Product::factory()->create(['image' => null, 'name' => 'mermelada']);
     }
     
    
    public function test_rattings_route()
    {

        $response = $this->post('/ratting/store', [$this->product]);

        $response->assertStatus(200);
    }

    public function test_registered_user_can_rate_products()
    {
        $this->actingAs($this->alfredo);

        $ratting = [ "ratting" => "5", "product_id" => "1"];

        $this->post(route('productRatting', $this->product->id), $ratting);

        $this->assertDatabaseCount('rattings', 1)
        ->assertDatabaseHas('rattings', ['ratting'=>'5']);
    }
}
