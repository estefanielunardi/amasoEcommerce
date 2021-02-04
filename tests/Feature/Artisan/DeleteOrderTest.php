<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Artisan;


class DeleteOrderTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);


        $this->product = Product::factory()->create(['image' => null, 'name' => 'mermelada']);
    }

    


    public function testAnOrderCanBeDeleted()
    {
        
        $this->get(route('cartAddProduct', $this->product->id));
        $this->put(route('purchase'));
        $this->assertDatabaseCount('product_user', 1);
        $response = $this->delete('/orders/delete/1');

        $this->assertDatabaseCount('product_user', 0);

        $response->assertRedirect();
    }
}
