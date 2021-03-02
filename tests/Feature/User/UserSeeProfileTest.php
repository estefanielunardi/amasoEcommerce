<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UserSeeProfileTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private user $alfredo;
    private Artisan $artisan;
    private Product $product2;
    private Product $product1;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create(['isArtisan' => true, 'id' => 1]);
        $this->alfredo = User::factory()->create(['name' => 'Alfredo', 'email' => 'alfredo@alfredo', 'password' => '12345678']);
        $this->artisan = Artisan::factory()->create(['user_id' => 1, 'id' => 1]);
        $this->product1 = Product::factory()->create(['image' => null, 'id' => 1, 'name' => 'mermelada', 'stock' => 4]);
        $this->product2 = Product::factory()->create(['image' => null, 'id' => 2, 'name' => 'pan', 'stock' => 4]);
    }    
    
    public function testUserRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $response = $this->get('/user/profile');

        $response->assertStatus(200);
    }

    public function testReturnUserProfile()
    {

        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $response = $this->get('/user/profile');

        $response->assertViewIs('user.userProfile');               
    }

    public function testReturnUserProfileWithHistoryProducts()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['id'=>4]));
        DB::table('product_user')
        ->insert(['product_id'=>1, 'user_id'=>4, 'updated_at'=> '2021-01-01','buyed' => 1]);
    
        $response = $this->get('/user/profile');

        $response->assertViewIs('user.userProfile')
        ->assertViewHas('userHistoryProducts')       
        ->assertViewHas('user');       
    }
    
}
