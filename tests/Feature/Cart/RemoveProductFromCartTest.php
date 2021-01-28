<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;

class RemoveProductFromCartTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteDeleteProductFromCart()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
               
        $product= Product::factory()->create(['image'=> null]);

        $response = $this->get(route('removeProductCart', $product->id));

        $response->assertRedirect('/');
    }

    public function testDecreaseAmountOfProductFromCartnDB()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product = Product::factory()->create(['image'=> null]);
        $this->get(route('cartAddProduct', $product->id));
        $this->get(route('cartAddProduct', $product->id));
        
        $this->get(route('removeProductCart', $product->id));

        $this->assertDatabaseCount('product_user', 1)
        ->assertDatabaseHas('product_user', ['product_id'=>1,'user_id'=>1, 'amount'=>1]);

    }

    public function testRemoveProductFromCartnDB()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product = Product::factory()->create(['image'=> null]);
        $this->get(route('cartAddProduct', $product->id));
        
        $this->get(route('removeProductCart', $product->id));

        $this->assertDatabaseCount('product_user', 0)
        ->assertDatabaseMissing('product_user', ['product_id'=>1,'user_id'=>1]);

    }
}
