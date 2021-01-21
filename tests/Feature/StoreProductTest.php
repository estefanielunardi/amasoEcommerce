<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;


class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    
    public function testStoreProduct()
    {
        $this->withoutExceptionHandling();
        $artisan= User::factory()->create();
        $this->actingAs($artisan);
        Artisan::factory()->create();
        
        $response = $this->post(route('storeProduct'),[
            'name'=>'Pan de trigo',
            'image'=>'/img/Pan.jpg',
            'description'=>'Un Pan de trigo',
            'price'=>10,
            'stock'=>20,
        ]);
        
        $response->assertRedirect('profileArtisan');
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products',['name'=>'Pan de trigo']);
    }


}
