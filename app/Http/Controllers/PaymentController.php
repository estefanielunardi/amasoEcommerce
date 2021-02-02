<?php

namespace App\Http\Controllers;

use App\Models\User;

class PaymentController extends Controller
{
    public function order(){

        $id = auth()->id();
        $user = User::find($id);
        $products = $user->getProductsInBasket($id);
        $total = $user->calculateTotal($products);

        return view('purchaseOrder', compact('products', 'total'));
    }

    public function purchase(){

        $user_id = auth()->id();  
        $user = User::find($user_id);    
        $user->buyProductsInBasket($user_id);
        
    }
}
