<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artisan;
use App\Models\User; 

class StoreArtisanTest extends TestCase
{
    use RefreshDatabase; 

    public function testStoreArtisan()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        $artisan = [
            'name' => 'Pepita', 
            'location' => 'Tarragona', 
            'description' => 'sfxghrsf', 
            'image' => 'image.jpg'
        ];
        
        $response = $this->post(route('artisanStore', $artisan));

        $this->assertDatabaseCount('artisans', 1)
                ->assertDatabaseHas('artisans', ['name' => 'Pepita']);

        $response->assertRedirect('artisan/pepita');

    }
}
