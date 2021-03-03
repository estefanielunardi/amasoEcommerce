<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;

class PaymentConfirmationTest extends TestCase
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
        $this->product1 = Product::factory()->create(['image' => null, 'id' => 1, 'name' => 'mermelada', 'stock' => 4, 'price'=>50]);
        $this->product2 = Product::factory()->create(['image' => null, 'id' => 2, 'name' => 'pan', 'stock' => 4]);
    }

    public function testRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->alfredo);
        $this->get(route('cartAddProduct', $this->product1->id));
        $token = [ 
            'stripeToken'=>'tok_visa',
        ];

        $response = $this->put(route('purchase'), $token);
        
        $response->assertRedirect('/');
    }

    public function testBuyProductsWhenPurchase()
    {
        $this->actingAs($this->user);
        $this->get(route('cartAddProduct', $this->product1->id));

        $this->put(route('purchase'));

        $this->assertDatabaseHas('product_user', ['buyed' => 1]);
    }

    public function testDecreaseProductStockAfterPurchase()
    {
        $this->actingAs($this->user);

        $this->get(route('cartAddProduct', $this->product1->id));
        $this->get(route('cartAddProduct', $this->product1->id));
        $this->get(route('cartAddProduct', $this->product2->id));
        $this->put('/purchase');

        $this->assertDatabaseHas('products', ['id' => 1, 'stock' => 2, 'name' => 'mermelada']);
        $this->assertDatabaseHas('products', ['id' => 2, 'stock' => 3, 'name' => 'pan']);
    }

    public function testSaveUserInformationCard()
    {
        $this->actingAs($this->alfredo);

        $checkoutFormData = [
            'direction' => 'calle tomas',
            'location' => 'Madrid',
        ];

        $this->put(route('purchase', $checkoutFormData));

        $this->assertDatabaseHas('users', [
            'name' => 'Alfredo',
            'email' => 'alfredo@alfredo',
            'password' => '12345678',
            'direction' => 'calle tomas',
            'location' => 'Madrid',
        ]);
    }

}
