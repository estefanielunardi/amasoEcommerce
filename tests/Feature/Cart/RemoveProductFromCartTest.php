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

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product = Product::factory()->create(['image' => null]);
    }
    public function testRouteDeleteProductFromCart()
    {
        $response = $this->delete(route('removeProductCart', $this->product->id));

        $response->assertRedirect();
    }

    public function testDecreaseAmountOfProductFromCartnDB()
    {
        $this->get(route('cartAddProduct', $this->product->id));
        $this->get(route('cartAddProduct', $this->product->id));

        $this->delete(route('removeProductCart', $this->product->id));

        $this->assertDatabaseCount('product_user', 1)
            ->assertDatabaseHas('product_user', ['product_id' => 1, 'user_id' => 1, 'amount' => 1]);
    }

    public function testRemoveProductFromCartnDB()
    {
        $this->get(route('cartAddProduct', $this->product->id));

        $this->delete(route('removeProductCart', $this->product->id));

        $this->assertDatabaseCount('product_user', 0)
            ->assertDatabaseMissing('product_user', ['product_id' => 1, 'user_id' => 1]);
    }
}
