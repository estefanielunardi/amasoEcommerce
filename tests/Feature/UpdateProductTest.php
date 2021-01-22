<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteIfUserIsAuth()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        Artisan::factory()->create();
        $product= Product::factory()->create();

        $response = $this->put(route('updateProduct', $product) , $product->toArray());
        
        $response->assertRedirect('artisan/1');
    }

    public function testDBHasBeenUpdate()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        Artisan::factory()->create();
        $product= Product::factory()->create();
        $product->name = 'Mermelada';
    
        $response = $this->put(route('updateProduct', $product) , $product->toArray());
        $this->assertDatabaseHas('products', ['name'=>'Mermelada']);
    
    }
}
