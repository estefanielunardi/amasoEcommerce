<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CheckoutFormTest extends TestCase
{   
    use RefreshDatabase;
    public function testCheckoutRoute()
    {
       $this->actingAs(User::factory()->create());
        $response = $this->get('/purchase/order');

        $response->assertStatus(200);
    }

    public function testCheckoutReturnView()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/purchase/order');

        $response->assertViewIs('cart.purchaseOrder')
        ->assertViewHas('products');

    }


}
