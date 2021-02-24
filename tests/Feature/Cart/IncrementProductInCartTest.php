<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;

class IncrementProductInCartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product = Product::factory()->create(['image' => null]);
    }
    public function testIncrementProductAmount()
    {
        $this->get(route('cartAddProduct', $this->product->id));
        $this->get(route('cartIncrementProduct', $this->product->id));

        $this->assertDatabaseCount('product_user', 1)
        ->assertDatabaseHas('product_user', ['product_id' => 1, 'user_id' => 1, 'amount' => 2]);
    }
}
