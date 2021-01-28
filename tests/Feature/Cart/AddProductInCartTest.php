<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Artisan;


class AddProductInCartTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteAddProductCart()
    {   
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product= Product::factory()->create(['image'=> null]);

        $response = $this->post(route('cartAddProduct', $product->id));

        $response->assertStatus(200);
    }

    public function testAddProductToCart()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product= Product::factory()->create(['image'=> null]);

        $response = $this->post(route('cartAddProduct', $product->id));

        $this->assertDatabaseCount('product_user', 1);


      

    }


}
