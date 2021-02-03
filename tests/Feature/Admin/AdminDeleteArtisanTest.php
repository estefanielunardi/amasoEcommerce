<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Mail\ArtisanProfileDeletedEmail;



class AdminDeleteArtisanTest extends TestCase
{
    use RefreshDatabase; 
    public function testAdminCanDeleteAnArtisan()
    {
        $admin = User::factory()->create([
            'name'=>'Estefanie',
            'email'=>'este@fani.es',
            'password'=>'12345678',
            'is_admin'=>true,
        ]); 

        $artisan = Artisan::factory()->create(['user_id'=>1, 'id'=>1, 'name'=>'Pepita']);
          
        $response = $this->actingAs($admin)
                ->delete('profiles/' . $artisan->id);

        $response->assertRedirect(route('adminDash'));
        $this->assertDatabaseCount('artisans', 0);
        $this->assertDatabaseMissing('artisans', ['name'=>'Pepita']);
                
    }

    public function testSendsEmailWhenProfileIsDeleted()
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
              
            $this->actingAs($admin)->delete('profiles/' . $artisan->id);
    
            Mail::assertSent(ArtisanProfileDeletedEmail::class);
    
        }

    public function testMailContent()
    {
        $user = User::factory()->create(['name'=>'Pepita','email'=>'pepi@ta','id'=>2,]);
        $mailable = new ArtisanProfileDeletedEmail($user->name);

        $mailable->assertSeeInHtml('Amasó');
        $mailable->assertSeeInHtml($user->name);
        $mailable->assertSeeInHtml('Lo sentimos Pepita, Tu perfil no ha sido aprovado');
        $mailable->assertSeeInHtml('Puedes mirar nuestros criterios de aceptacion en www.amaso.com');
    }
}




        


