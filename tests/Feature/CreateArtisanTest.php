<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArtisanTest extends TestCase
{
    use RefreshDatabase;

    public function testRouteJoinArtisanForm(){

        $response = $this->get('/joinArtisan');

        $response->assertStatus(200)
            ->assertViewIs('joinArtisan');

    }
}
