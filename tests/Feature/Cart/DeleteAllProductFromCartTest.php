<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Artisan;

class DeleteAllProductFromCartTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteDeleteAllProductsFromCart()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $response = $this->delete('/all/cart');

        $response->assertRedirect();
    }

    public function testRemoveAllProductsInDB()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        Artisan::factory()->create();
        Product::factory()->create(['id' => 1, 'name' => 'pan', 'stock' => 4]);
        Product::factory()->create(['id' => 2, 'name' => 'tomates', 'stock' => 4]);


        DB::table('product_user')
        ->insert(['product_id'=>1, 'user_id'=>1, 'updated_at'=> '2021-01-01','buyed' => 0]);

        DB::table('product_user')
        ->insert(['product_id'=>2, 'user_id'=>1, 'updated_at'=> '2021-02-26','buyed' => 0]);

        $this->delete('/all/cart');

        $this->assertDatabaseCount('product_user', 0)
        ->assertDatabaseMissing('product_user', ['product_id' => 1, 'user_id' => 1, 'product_id' => 2]);

    }
}
