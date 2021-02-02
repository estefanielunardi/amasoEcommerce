<?php

namespace App\Http\Controllers;

use App\Models\User;

class PaymentController extends Controller
{
    public function purchase(){

        $user_id = auth()->id();  
        $user = User::find($user_id);    
        $user->buyProductsInBasket($user_id);
        
    }
}
