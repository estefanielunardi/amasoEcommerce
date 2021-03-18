<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Artisan;
use App\Models\User;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteCategory()
    {
        $response = $this->get(route('category', ['bebidas']));

        $response->assertStatus(200);
    }

    public function testReturnProductInCategory()
    {
        User::factory()->create(['isArtisan' => true, 'id' => 1]);
        Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        Product::factory()->create(['image' => null, 'id' => 1, 'name' => 'mermelada', 'stock' => 4, 'category'=> 'bebidas']);
        $response = $this->get(route('category', ['bebidas']));

        $response->assertViewIs('welcome')
                    ->assertViewHas('products');
    }
}
