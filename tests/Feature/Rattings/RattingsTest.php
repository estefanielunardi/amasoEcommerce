<?php

namespace Tests\Feature;

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
        //$this->ratting = Ratting::factory()->create(['ratting' => 8, 'product_id' => 1, 'user_id' => 1] );
     }
     
    
    // public function test_rattings_route()
    // {
        
    //     $response = $this->post('/ratting/store', [$this->product]);

    //     $response->assertRedirect(route('productPage'), $this->product->id);
    // }

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

        $this->post(route('productRatting', $this->product->id), $ratting);

        $this->assertDatabaseCount('rattings', 1)
        ->assertDatabaseHas('rattings', ['ratting'=>'7', 'product_id' => 1, 'user_id' => 2]);
    }
}
