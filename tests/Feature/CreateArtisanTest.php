<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateArtisanTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteJoinArtisanForm(){

        $this->actingAs(User::factory()->create()); 

        $response = $this->get('/joinArtisan');

        $response->assertStatus(200)
            ->assertViewIs('joinArtisan');

    }

    public function testNoAuthCanNotSeeForm(){
        
        $response = $this->get('/joinArtisan');

        $response->assertStatus(302);
    }
}
