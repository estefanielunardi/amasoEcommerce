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
    
    private Artisan $artisan;
    private Product $product;

    protected function setUp() :void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['id'=>1,'isArtisan'=>true]));
        $this->artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        $this->product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);
    }
    
    public function testRoute()
    {   
        $response = $this->get(route('orders'));

        $response->assertStatus(200);
    }

    public function testReturnOrdersView()
    {
        $this->get(route('cartAddProduct', $this->product->id));
        $response = $this->get(route('orders'));
        $response->assertviewIs('artisanOrders');
        $response->assertviewIs('artisanOrders')
                ->assertViewHas('orders');
    }
}
