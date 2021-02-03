<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artisan;
use App\Models\Product;
use App\Mail\PurchaseConfirmation; 
use Illuminate\Support\Facades\Mail;

class PaymentConfirmationTest extends TestCase
{
    use RefreshDatabase;
    public function testRoute()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);       
        $product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);

        $this->get(route('cartAddProduct', $product->id));

        $response = $this->put('/purchase');

        $response->assertRedirect('/');
    }

    public function testBuyProductsWhenPurchase()
    {
        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);       
        $product= Product::factory()->create(['image'=> null, 'name'=>'mermelada']);

        $this->get(route('cartAddProduct', $product->id));

         $this->put(route('purchase'));

        $this->assertDatabaseHas('product_user', ['buyed'=>1]);
    }

    public function testDecreaseProductStockAfterPurchase()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create(['isArtisan'=>true, 'id'=>1]));        
        Artisan::factory()->create(['user_id'=>1, 'id'=>1]);       
        $mermelada = Product::factory()->create(['image'=> null,'id'=>1, 'name'=>'mermelada', 'stock'=>4]);
        $pan = Product::factory()->create(['image'=> null,'id'=>2, 'name'=>'pan', 'stock'=>4]);
        $this->get(route('cartAddProduct', $mermelada->id));
        $this->get(route('cartAddProduct', $mermelada->id));
        $this->get(route('cartAddProduct', $pan->id));
        $this->get(route('cartAddProduct', $pan->id));
        
        $this->put('/purchase');

        $this->assertDatabaseHas('products', ['id'=>1,'stock'=>2, 'name'=>'mermelada']);
        $this->assertDatabaseHas('products', ['id'=>2,'stock'=>2, 'name'=>'pan']);
    }

    public function testSaveUserInformationCard()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs(User::factory()->create(['name'=>'Alfredo', 'email'=>'alfredo@alfredo', 'password'=>'12345678']));

        $card = [
            'direction'=>'calle tomas',
            'location'=>'Madrid',
            'postal'=>2020,
            'number_card'=>'SE12345678',
            'expiring_date'=>'11/12/20',
        ];

        $response = $this->put(route('purchase',$card));

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users',['name'=>'Alfredo', 
                                        'email'=>'alfredo@alfredo', 
                                        'password'=>'12345678',
                                        'direction'=>'calle tomas',
                                        'location'=>'Madrid',
                                        'postal'=>2020,
                                        'number_card'=>'SE12345678',
                                        'expiring_date'=>'11/12/20']);
    
    }

    public function testSendsEmailWhenPurchaseIsCompleted()
    {
        $this->withoutExceptionHandling();
        Mail::fake();

        $this->actingAs(User::factory()->create(['name'=>'Pepita','email'=>'pepi@ta','id'=>2,]));

        $this->put('/purchase');

        Mail::assertSent(PurchaseConfirmation::class);

    }

        public function testMailContent()
    {
        $user = User::factory()->create(['name'=>'Pepita','email'=>'pepi@ta','id'=>2,]);
        $mailable = new PurchaseConfirmation($user->name);

        $mailable->assertSeeInHtml('Amasó');
        $mailable->assertSeeInHtml($user->name);
        $mailable->assertSeeInHtml('tu pedido ha sido realizado con éxito');
        $mailable->assertSeeInHtml('Gracias por confiar en nosotros.');
    }
}
