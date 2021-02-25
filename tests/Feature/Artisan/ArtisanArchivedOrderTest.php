<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;

class ArtisanArchivedOrderTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp() :void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(['id'=>1,'isArtisan'=>true]));
        $this->artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        $this->product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);
    } 

    public function testArtisanCanArchiveOrder()
    {
        $this->get(route('cartAddProduct', $this->product->id));
        $this->put(route('purchase'));
        $this->assertDatabaseHas('product_user', ['archived' => 0]);
       
        $response = $this->post('/orders/archive/1');

        $this->assertDatabaseHas('product_user', ['archived' => 1]);

        $response->assertRedirect();
    }
}
