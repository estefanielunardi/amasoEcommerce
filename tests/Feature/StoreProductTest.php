<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    
    public function testStoreProduct()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        
        $response = $this->post(route('storeProduct'),[
            'artisan'=>'Maria Rosa',
            'name'=>'Pan de trigo',
            'image'=>'/img/Pan.jpg',
            'description'=>'Un Pan de trigo',
            'price'=>10,
            'stock'=>20,
            'sold'=>15,
            'artisan_id'=>1,
        ]);
        
        $response->assertRedirect('profileArtisan');
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products',['name'=>'Pan de trigo']);
    }


}
