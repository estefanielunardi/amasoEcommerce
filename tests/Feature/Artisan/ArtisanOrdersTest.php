<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;

class ArtisanOrdersTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['id'=>1,'isArtisan'=>true]));
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        
        $response = $this->get(route('orders'));

        $response->assertStatus(200);
    }

    public function testReturnOrdersView()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['id'=>1,'isArtisan'=>true]));
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);

        $product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);

        $this->get(route('cartAddProduct', $product->id));
        $response = $this->get(route('orders'));
        $response->assertviewIs('artisanOrders');
        $response->assertviewIs('artisanOrders')
                ->assertViewHas('orders');
    }
}
