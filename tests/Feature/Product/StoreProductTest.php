<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    public function testStoreProduct()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1]);
        $product = [
            'name'=>'Pan de trigo',
            'description'=>'Un Pan de trigo',
            'price'=>10,
            'stock'=>20,
            'artisan_id'=>1
        ];
        $response = $this->post(route('storeProduct',$product));
        
        $response->assertRedirect('artisan/' . $artisan->slug);
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products',['name'=>'Pan de trigo']);
    }
}
