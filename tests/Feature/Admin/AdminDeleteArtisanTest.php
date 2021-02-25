<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Mail\ArtisanProfileDeletedEmail;


class AdminDeleteArtisanTest extends TestCase
{
    use RefreshDatabase;

    private Artisan $artisan;
    private User $user;
    private User $admin;

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
            'name' => 'Pepita',
        ]);
        $this->user = User::factory()->create(['name' => 'Pepita', 'email' => 'pepi@ta', 'id' => 2,]);
    }

    public function testAdminCanDeleteAnArtisan()
    {
        $response = $this->actingAs($this->admin)->delete('profiles/' . $this->artisan->id);

        $response->assertRedirect(route('adminDash'));
        $this->assertDatabaseCount('artisans', 0);
        $this->assertDatabaseMissing('artisans', ['name' => 'Pepita']);
    }

}
