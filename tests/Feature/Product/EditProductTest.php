<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Artisan;

class EditProductTest extends TestCase
{
    use RefreshDatabase;
    public function testRouteIfUserIsAuth()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        $product= Product::factory()->create();

        $response = $this->get('/product/edit/' . $product->id);

        $response->assertStatus(200);
    }

    public function testReturnViewOfEditForm()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        $product= Product::factory()->create();

        $response = $this->get('/product/edit/' . $product->id);

        $response->assertViewIs('products.edit')
            ->assertViewHas(['product'=>$product]);
    }
}
