<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;
    public function test_route()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function test_return_catalog_view()
    {
        $response = $this->get(route('home'));

        $response->assertViewIs("welcome");
    }

    public function test_catalog_view_has_products()
    {
         $response = $this->get(route('home'));

        $response->assertViewIs("welcome")
        ->assertViewHas("products");
    }

}
