<?php

namespace Tests\Feature\Rattings;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Ratting;

class RattingsTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;
    private User $alfredo;
    private Artisan $artisan;
    
    protected function setUp(): void
     {
        parent::setUp();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        $this->alfredo = User::factory()->create(['name' => 'Alfredo', 'email' => 'alfredo@alfredo', 'password' => '12345678']);
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product = Product::factory()->create(['id'=>1,'image' => null, 'name' => 'mermelada']);
        

     }
     
    
    public function test_rattings_route()
    {
        
        $response = $this->post('/ratting/store/1');
        $response->assertRedirect();
        
    }

    public function test_registered_user_can_rate_products()
    {
        $this->actingAs($this->alfredo);
        $ratting = [ "ratting" => "5", "product_id" => "1"];
        $this->post(route('productRatting', $this->product->id), $ratting);
        $this->assertDatabaseCount('rattings', 1)
        ->assertDatabaseHas('rattings', ['ratting'=>'5']);
    }

    public function test_registered_user_cant_rate_more_than_once()
    {
        $this->actingAs($this->alfredo);
        $ratting = ['ratting' => 7, 'product_id' => 1, 'user_id' => 1] ;    
        $ratting2 = ['ratting' => 2, 'product_id' => 1, 'user_id' => 1] ;    
        $this->post(route('productRatting', $this->product->id), $ratting);
        $this->post(route('productRatting', $this->product->id), $ratting2);
        $this->assertDatabaseCount('rattings', 1)
        ->assertDatabaseHas('rattings', ['ratting'=>'2', 'product_id' => 1, 'user_id' => 2]);
    }
}
