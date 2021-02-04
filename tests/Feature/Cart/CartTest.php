<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }


    public function testCartRoute()
    {
        $response = $this->get(route('cart'));

        $response->assertStatus(200);
    }

    public function testReturnCartView()
    {
        $response = $this->get(route('cart'));

        $response->assertViewIs("cart.cart");
    }

    public function testCartViewHasProducts()
    {
        $response =  $this->get(route('cart'));

        $response->assertViewIs("cart.cart")
            ->assertViewHas(["products", "total"]);
    }
}
