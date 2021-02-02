<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Artisan;

class DeleteProductFromCartTest extends TestCase
{
   use RefreshDatabase;

    public function testRouteDeleteProductFromCart()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);

        $product = Product::factory()->create(['image' => null]);

        $response = $this->delete(route('deleteProductCart', $product->id));

        $response->assertRedirect();
    }

    public function testDeleteProductFromCartnDB()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product = Product::factory()->create(['image'=> null]);
        $this->get(route('cartAddProduct', $product->id));
        $this->get(route('cartAddProduct', $product->id));
        $this->get(route('cartAddProduct', $product->id));
        
        $this->delete(route('deleteProductCart', $product->id));

        $this->assertDatabaseCount('product_user', 0)
        ->assertDatabaseMissing('product_user', ['product_id'=>1,'user_id'=>1]);

    }
}
