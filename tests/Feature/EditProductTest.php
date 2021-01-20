<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class EditProductTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteIfUserIsAuth()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $product= Product::factory()->create();

        $response = $this->get('/product/edit/' . $product->id);

        $response->assertStatus(200);
    }

    public function testReturnViewOfEditForm()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $product= Product::factory()->create();

        $response = $this->get('/product/edit/' . $product->id);

        $response->assertViewIs('products.edit')
            ->assertViewHas(['product'=>$product]);
    }
}
