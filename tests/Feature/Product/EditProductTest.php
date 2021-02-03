<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;

class EditProductTest extends TestCase
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
    public function testRouteIfUserIsAuth()
    {
        $response = $this->get('/product/edit/' . $this->product->id);

        $response->assertStatus(200);
    }

    public function testReturnViewOfEditForm()
    {
        $response = $this->get('/product/edit/' . $this->product->id);

        $response->assertViewIs('products.edit')
            ->assertViewHas(['product' => $this->product]);
    }
}
