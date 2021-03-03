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
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product = Product::factory()->create(['image' => null]);
    }

    public function testRouteDeleteProductFromCart()
    {
        $response = $this->delete(route('deleteProductCart', $this->product->id));

        $response->assertRedirect();
    }

    public function testDeleteProductFromCartnDB()
    {
        $this->get(route('cartAddProduct', $this->product->id));
        $this->get(route('cartAddProduct', $this->product->id));
        $this->get(route('cartAddProduct', $this->product->id));

        $this->delete(route('deleteProductCart', $this->product->id));

        $this->assertDatabaseCount('product_user', 0)
            ->assertDatabaseMissing('product_user', ['product_id' => 1, 'user_id' => 1]);
    }

    public function testNotDeleteProductPreviousBuyedFromCart()
    {
        $this->get(route('cartAddProduct', $this->product->id));

        $this->put(route('purchase'));

        $this->get(route('cartAddProduct', $this->product->id));
       
        $this->delete(route('deleteProductCart', $this->product->id));

        $this->assertDatabaseCount('product_user', 1)
            ->assertDatabaseMissing('product_user', ['product_id' => 1, 'user_id' => 1, 'id'=>2])
            ->assertDatabaseHas('product_user', ['product_id' => 1, 'user_id' => 1 , 'id'=>1 , 'buyed'=>true]);
    }
}
