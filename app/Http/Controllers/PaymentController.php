<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Stripe;
use PHPUnit\Framework\Exception;
use App\Repositories\Cart\CartRepository;

class PaymentController extends Controller
{ 
    private CartRepository $cartRepo;

    public function __construct()
    {
        $this->cartRepo = new CartRepository;
    }

    public function order()
    {

        $id = auth()->id();
        $user = User::find($id);
        $products =  $this->cartRepo->getProductsInBasket($id);
        $total =  $this->cartRepo->calculateTotal($products);

        return view('cart.purchaseOrder', [ 'intent' => $user->createSetupIntent()],  compact('products', 'total', 'user'));
    }

    public function purchase(Request $request)
    {   
        $user_id = auth()->id();
        $products = $this->cartRepo->getPurchasedProducts($user_id);
        $total = $this->cartRepo->calculateTotal($products); 
        $amount = $total * 100; 
        
        $this->cartRepo->buyProductsInBasket($user_id);
        $user = User::find($user_id);
        $user->id = $user->id;
        $user->name = $user->name;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->direction = $request->direction;
        $user->location = $request->location;
        $user->cardholder = $request->cardholder;
        
        $user->save(); 
        // $this->createStripeCharge($request->stripeToken, $amount);    

        return redirect('/')
        ->with('message' , '¡Compra realizada con éxito, muchas gracias!');

    }

    private function createStripeCharge($token, $amount)
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                    "amount" => $amount,
                    "currency" => "eur",
                    "source" => $token,
                    "description" => 'Compra en Amasó'
            ]); 
        }
        catch (Exception $e) {
            $e->getMessage(["Oh no, ha habido un error!"]);

            // return view('cart.purchaseOrder', ["message" => "Oh no, ha habido un error!"]);
        }
    }

}
