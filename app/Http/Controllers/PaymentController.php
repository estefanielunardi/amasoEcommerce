<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseConfirmation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function order()
    {

        $id = auth()->id();
        $user = User::find($id);
        $products = $user->getProductsInBasket($id);
        $total = $user->calculateTotal($products);

        return view('purchaseOrder', compact('products', 'total', 'user'));
    }

    public function purchase(Request $request)
    {
        $user_id = auth()->id();
        $user = User::find($user_id);
        $user->buyProductsInBasket($user_id);
        
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

        $emailUser = DB::table('users')->where('id', $user_id)->value('email');
        $name = DB::table('users')->where('id', $user_id)->value('name');

        Mail::to($emailUser)->send(new PurchaseConfirmation($name));
        
        return redirect('/')
        ->with('message' , 'Confirmacion! Gracias por su compra!');

    }
}
