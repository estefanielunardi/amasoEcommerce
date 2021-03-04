<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Artisan;
use Illuminate\Support\Facades\DB;


class AddProductInCartTest extends TestCase
{

    use RefreshDatabase;

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);

        $this->product = Product::factory()->create(['id'=>1,'image' => null, 'name' => 'mermelada']);
    }

    public function testRouteAddProductCart()
    {
        $response = $this->get(route('cartAddProduct', $this->product->id));

        $response->assertRedirect('/');
    }

    public function testAddProductToCart()
    {
        $this->get(route('cartAddProduct', $this->product->id));

        $this->assertDatabaseCount('product_user', 1)
            ->assertDatabaseHas('product_user', ['product_id' => 1, 'user_id' => 1, 'amount' => 1]);
    }

    public function testAddProductToCartWithSameProductWasBought()
    {
        DB::table('product_user')
        ->insert(['product_id'=>1, 'user_id'=>1, 'updated_at'=> '2021-01-01','amount' => 1,'buyed' => 1]);
    
        $this->get(route('cartAddProduct', $this->product->id));
        $this->get(route('cartAddProduct', $this->product->id));

        $this->assertDatabaseCount('product_user', 2)
            ->assertDatabaseHas('product_user', 
                ['product_id' => 1, 'user_id' => 1, 'amount' => 1, 'buyed' => 0, 
                 'product_id' => 1, 'user_id' => 1, 'amount' => 2, 'buyed' => 0]);
    }
}
