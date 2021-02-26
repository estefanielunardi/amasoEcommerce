<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserSeeProfileTest extends TestCase
{
    use RefreshDatabase;
    public function testUserRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $response = $this->get('/user/profile/1');

        $response->assertStatus(200);
    }

    public function testReturnUserProfile()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $response = $this->get('/user/profile/1');

        $response->assertViewIs('user.userProfile');
       
    }
}
