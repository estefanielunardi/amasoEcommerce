<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;
use Illuminate\Support\Carbon;
use App\Repositories\Cart\CartRepository;
class ProductBestSellerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['isArtisan' => true, 'id' => 1]);
        $this->alfredo = User::factory()->create(['name' => 'Alfredo', 'email' => 'alfredo@alfredo', 'password' => '12345678']);
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product1 = Product::factory()->create(['image' => null, 'id' => 1, 'name' => 'mermelada', 'stock' => 4]);
        $this->product2 = Product::factory()->create(['image' => null, 'id' => 2, 'name' => 'pan', 'stock' => 4]);
        $this->product3 = Product::factory()->create(['image' => null, 'id' => 3, 'name' => 'pan', 'stock' => 4]);
        $this->product4 = Product::factory()->create(['image' => null, 'id' => 4, 'name' => 'pan', 'stock' => 4]);
        $this->cartRepo = new CartRepository;
    }
    public function testDoesNotReturnBestSellerIdIfNotSoldProduct()
    {               
        $response = $this->cartRepo->getBestSellersIds();
        $this->assertEmpty($response);        
    }

    public function testReturnOneBestSellerIdProduct()
    {       
        $this->actingAs($this->alfredo);
        $this->get(route('cartAddProduct', $this->product1->id));
        $this->put('/purchase');

        $response = $this->cartRepo->getBestSellersIds();
        $this->assertEquals([1], $response); 
    }

    public function testReturnThreeBestSellerIdsProducts()
    {       
        $this->actingAs($this->alfredo);
        $this->get(route('cartAddProduct', $this->product1->id));
        $this->get(route('cartAddProduct', $this->product2->id));
        $this->get(route('cartAddProduct', $this->product3->id));
        $this->put('/purchase');

        $response = $this->cartRepo->getBestSellersIds();
        $this->assertEquals([1, 2, 3], $response); 
    }

    public function testReturnOnlyThreeBestSellerIdsProducts()
    {       
        $this->actingAs($this->alfredo);
        $this->get(route('cartAddProduct', $this->product1->id));
        $this->get(route('cartAddProduct', $this->product2->id));
        $this->get(route('cartAddProduct', $this->product3->id));
        $this->get(route('cartAddProduct', $this->product4->id));
        $this->put('/purchase');

        $response = $this->cartRepo->getBestSellersIds();
        $this->assertEquals([1, 2, 3], $response); 
    }

    public function testReturnOnlyThreeBestSellerIdsProductsSortByOrder()
    {       
        $this->actingAs($this->alfredo);
        $this->get(route('cartAddProduct', $this->product1->id));
        $this->get(route('cartAddProduct', $this->product2->id));
        $this->get(route('cartAddProduct', $this->product3->id));
        $this->get(route('cartAddProduct', $this->product3->id));
        $this->get(route('cartAddProduct', $this->product4->id));
        $this->get(route('cartAddProduct', $this->product4->id));
        $this->get(route('cartAddProduct', $this->product4->id));
        $this->put('/purchase');

        $response = $this->cartRepo->getBestSellersIds();
        $this->assertEquals([4, 3, 1], $response); 
    }

    public function testReturnBestSellersIdsOfTheMonth()
    {
        $testDate = Carbon::create(2021, 2, 28, 1, 1);
        Carbon::setTestNow($testDate);

        DB::table('product_user')
        ->insert(['product_id'=>1, 'user_id'=>1, 'updated_at'=> '2021-01-01','buyed' => 1]);

        DB::table('product_user')
        ->insert(['product_id'=>2, 'user_id'=>1, 'updated_at'=> '2021-02-26','buyed' => 1]);

        $response = $this->cartRepo->getBestSellersIds();
        $this->assertEquals([2],$response); 
    }
}
