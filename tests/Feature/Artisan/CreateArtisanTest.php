<?php

namespace Tests\Feature\Artisan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CreateArtisanTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteJoinArtisanForm(){

        $this->actingAs(User::factory()->create()); 

        $response = $this->get('/joinArtisan');

        $response->assertStatus(200)
            ->assertViewIs('artisan.joinArtisan');

    }

    public function testNoAuthCanNotSeeForm(){
        
        $response = $this->get('/joinArtisan');

        $response->assertStatus(302);
    }
}
