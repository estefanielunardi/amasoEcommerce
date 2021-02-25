<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;

class ShowProductTest extends TestCase
{
    use RefreshDatabase;
    
    private Product $product;
    private Artisan $artisan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product = Product::factory()->create();
    }

    public function test_product_page_is_showed()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/product/' . $this->product->id);

        $response->assertStatus(200)
            ->assertViewIs('products.productPage')
            ->assertViewHas(['product' => $this->product]);
    }
}
