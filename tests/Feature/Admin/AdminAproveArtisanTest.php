<?php

namespace Tests\Feature;

use App\Mail\ArtisanProfileAprovedEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use Illuminate\Support\Facades\Mail;

class AdminAproveArtisanTest extends TestCase
{

    use RefreshDatabase;

    private Artisan $artisan;
    private User $admin;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create([
            'name' => 'Estefanie',
            'email' => 'este@fani.es',
            'password' => '12345678',
            'is_admin' => true,
            'id' => 1,
        ]);
        $this->user = User::factory()->create([
            'name' => 'Pepita',
            'email' => 'pepi@ta',
            'id' => 2,
        ]);

        $this->artisan = Artisan::factory()->create([
            'user_id' => 2,
            'id' => 1,
            'name' => 'Pepita',
            'aproved' => false
        ]);
    }

    public function testAdminCanAproveArtisan()
    {
        $response = $this->actingAs($this->admin)
            ->post('profiles/' . $this->artisan->id);

        $response->assertRedirect(route('adminDash'));
        $this->assertDatabaseHas('artisans', ['name' => 'Pepita', 'aproved' => true]);
    }

    public function testSendsEmailWhenProfileIsAproved()
    {
        Mail::fake();

        $this->actingAs($this->admin)->post('profiles/' . $this->artisan->id);

        Mail::assertSent(ArtisanProfileAprovedEmail::class);
    }

    public function testMailContent()
    {
        $mailable = new ArtisanProfileAprovedEmail($this->user->name);

        $mailable->assertSeeInHtml('Amasó');
        $mailable->assertSeeInHtml($this->user->name);
        $mailable->assertSeeInHtml('Felicidades Pepita! Tu perfil ha sido aprovado');
        $mailable->assertSeeInHtml('Ya puedes subir tus productos en www.amaso.com');
    }
}
