<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteIfUserIsAuth()
    {
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));

        $response = $this->get(route('newProduct'));

        $response->assertStatus(200);
    }

    public function testReturnNewProductForm()
    {
        $this->actingAs(User::factory()->create(['isArtisan' => true, 'id' => 1]));

        $response = $this->get(route('newProduct'));

        $response->assertViewIs('products.create');
    }
}
