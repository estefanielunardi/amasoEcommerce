<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserCanUpdateInfoTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->patch(route('userUpdate', ['name'=>'juan']));

        $response->assertRedirect('/user/profile/');
    }

    public function testUpdateUserName()
    {
        $this->actingAs(User::factory()->create(['name'=>'pedro']));
        
        $this->patch(route('userUpdate', ['name'=>'juan']));

        $this->assertDatabaseHas('users', ['name'=>'juan']);

    }
}
