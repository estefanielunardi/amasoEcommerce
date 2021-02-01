<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product= Product::factory()->create(['image'=> null]);

        $response = $this->get(route('cartAddProduct', $product->id));

        $response->assertRedirect('/');
    }

    public function testAddProductToCart()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);

        $this->get(route('cartAddProduct', $product->id));

        $this->assertDatabaseCount('product_user', 1)
        ->assertDatabaseHas('product_user', ['product_id'=>1,'user_id'=>1, 'amount'=>1]);
    }

}
