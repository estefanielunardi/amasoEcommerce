<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;

class PaymentConfirmationTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);       
        $product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);

        $this->get(route('cartAddProduct', $product->id));

        $this->get('/purchase');
        $response = $this->get('/purchase');

        $response->assertStatus(200);
    }

    public function testBuyProductsWhenPurchase()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);       
        $product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);

        $this->get(route('cartAddProduct', $product->id));

        $this->get('/purchase');

        $this->assertDatabaseHas('product_user', ['buyed'=>1]);
    }

    public function testDecreaseProductStockAfterPurchase()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);       
        $product = Product::factory()->create(['image'=> null,'id'=>1, 'name'=>'mermelada', 'stock'=>4]);
        $this->get(route('cartAddProduct', $product->id));
        $this->get(route('cartAddProduct', $product->id));
        
        $this->get('/purchase');

        $this->assertDatabaseHas('products', ['id'=>1,'stock'=>2]);
    }
}
