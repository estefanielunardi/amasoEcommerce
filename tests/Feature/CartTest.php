<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    // public function testCartRoute()
    // {
    //     $response = $this->get(route('cart'));

    //     $response->assertStatus(200);
    // }

    // public function testReturnCartView()
    // {
    //     $response = $this->get(route('cart'));

    //     $response->assertViewIs("cart");
    // }

    // public function testCartViewHasProducts()
    // {
    //     $this->withoutExceptionHandling();
    //     $response =  $this->get(route('cart'));

    //     $response->assertViewIs("cart")
    //     ->assertViewHas("products");
    // }

   // public function testCanSelectProductFromCatalogue()


   // public function testAuthUserCanAddProductsToCart()
   

}

