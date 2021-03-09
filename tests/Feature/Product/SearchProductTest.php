<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;

class SearchProductTest extends TestCase
{
   use RefreshDatabase;
    public function testRouteSearch()
    {
        $response = $this->post('/product/search/');

        $response->assertRedirect();
    }

    public function testReturnMessageIfNoFindProduct()
    {
        $response = $this->post(route('searchProduct', ['pan']));

        $response->assertRedirect() ->with('message' , 'No se han encontrado resultados a su búsqueda');
    }

    public function testReturnViewIfFindProduct()
    {
        User::factory()->create();
        Artisan::factory()->create();
        Product::factory()->create(['name'=>'Pan']);

        $response = $this->post(route('searchProduct', ['pan']));

        $response->assertViewIs('products.searchedProduct')
                    ->assertViewHas('products');
    }
}