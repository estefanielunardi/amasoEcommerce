<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseConfirmation;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;

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
        $user = User::find($user_id);
        Cart::buyProductsInBasket($user_id);
        $user->id = $user->id;
        $user->name = $user->name;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->direction = $request->direction;
        $user->location = $request->location;
        $user->postal = $request->postal;
        $user->card = $request->card;
        $user->expiring = $request->expiring;
        $user->cardholder = $request->cardholder;
        
        $user->save(); 

        $products = Cart::getPurchasedProducts($user_id);
        $total = Cart::calculateTotal($products);
        $emailUser = DB::table('users')->where('id', $user_id)->value('email');
        $name = DB::table('users')->where('id', $user_id)->value('name');
        
        return redirect('/')
        ->with('message' , '¡Compra realizada con éxito, muchas gracias!');

    }

    public function cashier(){

        $user_id = auth()->id();
        $stripeId = DB::table('users')->where('id', $user_id)->value('stripe_id');
        $user = Cashier::findBillable($stripeId);
      
        return view('payment' , [ 'intent' => $user->createSetupIntent()]);
    
    }

}
