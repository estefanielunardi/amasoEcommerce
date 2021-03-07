<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserEditInfoFormTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/user/edit');

        $response->assertStatus(200);
    }

    public function testReturnUserForm()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/user/edit');

        $response->assertViewIs('user.editForm')
        ->assertViewHas('name');
    }

}
