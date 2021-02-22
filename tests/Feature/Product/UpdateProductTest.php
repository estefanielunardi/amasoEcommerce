<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;
    private Artisan $artisan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);

        $this->product = Product::factory()->create(['image' => null , 'highlight' => 0]);
    }

    public function testRouteIfUserIsAuth()
    {
        $this->withoutExceptionHandling();
        $response = $this->put(route('updateProduct', $this->product), $this->product->toArray());

        $response->assertRedirect('artisan/' . $this->artisan->slug);
    }

    public function testDBHasBeenUpdate()
    {
        $this->product->name = 'Mermelada';

        $this->put(route('updateProduct', $this->product), $this->product->toArray());
        $this->assertDatabaseHas('products', ['name' => 'Mermelada']);
    }
}
