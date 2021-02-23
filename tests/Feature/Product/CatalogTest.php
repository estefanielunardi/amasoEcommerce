<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteCatalog()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function testReturnCatalogView()
    {
        $response = $this->get(route('home'));

        $response->assertViewIs("welcome");
    }

    public function testCatalogViewHasProducts()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('home'));

        $response->assertViewIs("welcome")
            ->assertViewHas("products")
            ->assertDontSee('bestSellers');           
    }
}
