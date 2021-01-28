<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function getProducts()
    {
        $id = auth()->id();
        $products = DB::select("SELECT * FROM `products`
                WHERE `id` IN (
                    SELECT `product_id` FROM `product_user` WHERE `user_id` = $id);");
                
        return view('cart', compact("products"));
    }

    public function addProduct($product_id)
        {
            $user_id = auth()->id();
            $user = User::find($user_id); 
            $userProduct = $user->products()->find($product_id);
            if(is_null($userProduct))
            {
                $user->products()->attach($product_id);
                DB::table('product_user')
                        ->where('user_id',$user_id)
                        ->where('product_id',$product_id)
                        ->increment('amount', 1);
            }
            else
            {
                DB::table('product_user')
                        ->where('user_id',$user_id)
                        ->where('product_id',$product_id)
                        ->increment('amount', 1);
            }


            return redirect('/');            
        }
    
    public function removeProduct($product_id)
    {
        $user_id = auth()->id();
        $user = User::find($user_id); 
        $userProduct = $user->products()->find($product_id);

        if($userProduct)
        {
            $amount = DB::table('product_user')
                        ->where('user_id',$user_id)
                        ->where('product_id',$product_id)
                        ->get('amount');
    
            $num = $amount[0]->amount;
            if ($num == 1)
            {
                $user->products()->detach($product_id);
            }
            else
            {
                DB::table('product_user')
                        ->where('user_id',$user_id)
                        ->where('product_id',$product_id)
                        ->decrement('amount', 1);
            }

        }    
        return redirect('/'); 
    }

}
