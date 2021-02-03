<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;

class DeleteProductTest extends TestCase
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
        $response = $this->delete('/product/' . $this->product->id);

        $response->assertStatus(302);
    }

    public function testDeleteProduct()
    {
        $response = $this->delete('/product/' . $this->product->id);

        $response->assertRedirect('artisan/' . $this->artisan->slug);
        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseMissing('products', $this->product->toArray());
    }
}
