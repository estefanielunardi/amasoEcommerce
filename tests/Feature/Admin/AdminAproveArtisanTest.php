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
    
        public function testAdminCanAproveArtisan()
        {
            $admin = User::factory()->create([
                'name'=>'Estefanie',
                'email'=>'este@fani.es',
                'password'=>'12345678',
                'is_admin'=>true,
                'id'=>1,
            ]); 
            User::factory()->create([
                'name'=>'Pepita',
                'email'=>'pepi@ta',
                'id'=>2,
            ]); 
    
            $artisan = Artisan::factory()->create(['user_id'=>2, 'id'=>1, 'name'=>'Pepita', 'aproved'=>false]);
              
            $response = $this->actingAs($admin)
                    ->post('profiles/' . $artisan->id);
    
            $response->assertRedirect(route('adminDash'));
            $this->assertDatabaseHas('artisans', ['name'=>'Pepita', 'aproved'=>true]);
            
                    
        }

        public function testSendsEmailWhenProfileIsAproved()
        {
            $this->withoutExceptionHandling();
            Mail::fake();
            $admin = User::factory()->create([
                'name'=>'Estefanie',
                'email'=>'este@fani.es',
                'password'=>'12345678',
                'is_admin'=>true,
            ]); 

            User::factory()->create(['name'=>'Pepita','email'=>'pepi@ta','id'=>2,]);
    
            $artisan = Artisan::factory()->create(['user_id'=>2, 'id'=>1, 'name'=>'Pepita', 'aproved'=>false]);
              
            $this->actingAs($admin)->post('profiles/' . $artisan->id);
    
            Mail::assertSent(ArtisanProfileAprovedEmail::class);
    
        }

        public function testMailContent()
    {
        $user = User::factory()->create(['name'=>'Pepita','email'=>'pepi@ta','id'=>2,]);
        $mailable = new ArtisanProfileAprovedEmail($user->name);

        $mailable->assertSeeInHtml('Amasó');
        $mailable->assertSeeInHtml($user->name);
        $mailable->assertSeeInHtml('Felicidades Pepita! Tu perfil ha sido aprovado');
        $mailable->assertSeeInHtml('Ya puedes subir tus productos en www.amaso.com');
    }
    
}