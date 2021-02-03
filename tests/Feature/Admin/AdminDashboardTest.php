<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;


class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Artisan $artisan;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create([
            'name' => 'Estefanie',
            'email' => 'este@fani.es',
            'password' => '12345678',
            'is_admin' => true,
        ]);

        $this->artisan = Artisan::factory()->create([
            'user_id' => 1,
            'id' => 1,
        ]);
    }

    public function testAdminDashboardRoute()
    {
        $response = $this->actingAs($this->admin)->get('/admin');

        $response->assertStatus(200)
            ->assertViewIs('adminDashboard')
            ->assertViewHas('artisanList');
    }

    public function testAdminDashboardLinksArtisanProfile()
    {
        $response = $this->actingAs($this->admin)->get('artisan/' . $this->artisan->slug);

        $response->assertStatus(200)
            ->assertViewIs('profileArtisan')
            ->assertViewHas('artisan')
            ->assertSee($this->artisan->id);
    }
}
