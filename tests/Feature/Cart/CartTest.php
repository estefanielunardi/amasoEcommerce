<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CartTest extends TestCase
{
    use RefreshDatabase;

    
    public function testCartRoute()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('cart'));

        $response->assertStatus(200);
    }

    public function testReturnCartView()
    {
        $this->actingAs(User::factory()->create());
        
        $response = $this->get(route('cart'));

        $response->assertViewIs("cart");
    }

    public function testCartViewHasProducts()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $response =  $this->get(route('cart'));

        $response->assertViewIs("cart")
        ->assertViewHas("products");
    }   

}

