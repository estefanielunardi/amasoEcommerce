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
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product= Product::factory()->create();

        $response = $this->put(route('updateProduct', $product) , $product->toArray());
        
        $response->assertRedirect('artisan/' . $artisan->slug);
    }

    public function testDBHasBeenUpdate()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
       
        $product= Product::factory()->create();
        $product->name = 'Mermelada';
    
        $this->put(route('updateProduct', $product) , $product->toArray());
        $this->assertDatabaseHas('products', ['name'=>'Mermelada']);
    
    }
}
