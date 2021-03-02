<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function order()
    {

        $id = auth()->id();
        $user = User::find($id);
        $products = Cart::getProductsInBasket($id);
        $total = Cart::calculateTotal($products);

        return view('cart.purchaseOrder', [ 'intent' => $user->createSetupIntent()],  compact('products', 'total', 'user'));
    }

    public function purchase(Request $request)
    {   
        $user_id = auth()->id();
        $products = Cart::getPurchasedProducts($user_id);
        $total = Cart::calculateTotal($products); 
        $amount = $total * 100; 
        
        Cart::buyProductsInBasket($user_id);
        $user = User::find($user_id);
        $user->id = $user->id;
        $user->name = $user->name;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->direction = $request->direction;
        $user->location = $request->location;
        $user->cardholder = $request->cardholder;
        
        $user->save(); 
        $this->createStripeCharge($request->stripeToken, $amount);    

        return redirect('/')
        ->with('message' , '¡Compra realizada con éxito, muchas gracias!');

    }

    private function createStripeCharge($token, $amount)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $amount,
                "currency" => "eur",
                "source" => $token,
                "description"=> "Compra en amaso"
        ]); 
    }

}
