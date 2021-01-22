<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteIfUserIsAuth()
    {
        $this->withoutExceptionHandling();
        $this-> actingAs(User::factory()->create());
        $product= Product::factory()->create();
       
        $response = $this->delete('/product/' . $product->id);

        $response->assertStatus(302);
    }

    public function testDeleteProduct()
    {
        $this->withoutExceptionHandling();
        $this-> actingAs(User::factory()->create());
        $product= Product::factory()->create();
       
        $response = $this->delete('/product/' . $product->id);

        $response->assertRedirect('artisan/1');
        $this->assertDatabaseCount('products', 0);
        $this->assertDatabaseMissing('products', $product->toArray());
    }
    
}
