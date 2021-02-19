<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    public static function incrementProductAmount($product_id,$user_id)
    {
        DB::table('product_user')
                    ->where('user_id',$user_id)
                    ->where('product_id',$product_id)
                    ->increment('amount', 1);
    } 

    public static function findProduct($product_id, $user_id)
    {
        $buyed = DB::table('product_user')
                    ->where('user_id',$user_id)
                    ->where('product_id',$product_id)
                    ->value('buyed');
        return $buyed;
    }

    public static function addProductInCart($product_id, $user_id)
    {               
        $user = User::find($user_id);        
        $buyed = Cart::findProduct($product_id, $user_id);
        $userProduct = $user->products()->find($product_id);
        
        if(is_null($userProduct) || $buyed)
        {
            $user->products()->attach($product_id);
            Cart::incrementProductAmount($product_id,$user_id);  
        }
        else
        {
            Cart::incrementProductAmount($product_id,$user_id);  
        }
    }

    public static function deleteProductFromCart($product_id, $user_id)
    {
        $user = User::find($user_id);   
        $user->products()->detach($product_id);
    
    }

    public static function removeProductFromCart($product_id,$user_id)
    {
        $user = User::find($user_id);
        $userProduct = $user->products()->find($product_id);

        if($userProduct)
        {
            $amount = Cart::getProductAmount($product_id,$user_id);    
            
            if ($amount == 1)
            {
                $user->products()->detach($product_id);
            }
            else
            {
                Cart::decrementProductAmount($product_id,$user_id);
            }
        }  
    }

    public static function decrementProductAmount($product_id,$user_id)
    {
        DB::table('product_user')
            ->where('user_id',$user_id)
            ->where('product_id',$product_id)
            ->decrement('amount', 1);
    }

    public static function getProductAmount($product_id,$user_id)
    {
        $amount = DB::table('product_user')
                    ->where('user_id',$user_id)
                    ->where('product_id',$product_id)
                    ->value('amount');
        return $amount;
    }

    public static function getProductsInBasket($id)
    {
        $products = DB::table('products')
        ->join('product_user', 'products.id', '=', 'product_user.product_id')   
        ->where('user_id','=', $id)
        ->where('buyed', '=', 0)
        ->select('products.*', 'product_user.amount')
        ->get();
    
        return $products;
    }

    public static function calculateTotal($products)
    {
        $total = 0;
        foreach($products as $product)
        {
            $total += ($product->price * $product->amount)/100;
        }
        return $total;
    }

    public static function buyProductsInBasket($user_id){
        Product::decrementStock($user_id);
        
        DB::table('product_user')
            ->where('user_id',$user_id)
            ->update(['buyed' => 1]);
    }

    public static function getPurchasedProducts($id)
    {
        $products = DB::table('products')
        ->join('product_user', 'products.id', '=', 'product_user.product_id')   
        ->where('user_id','=', $id)
        ->where('buyed', '=', 1)
        ->select('products.*', 'product_user.amount')
        ->get();
    
        return $products;
    }

}
