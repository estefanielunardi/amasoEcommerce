<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isArtisan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function artisan()
    {
       return $this->hasOne(Artisan::class);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getProductsInBasket($id)
    {
        $products = DB::select("SELECT * FROM `products`
                WHERE `id` IN (
                    SELECT `product_id` FROM `product_user` WHERE `user_id` = $id);");
        

        return $products;
    }

    public function calculateTotal($products)
    {
        $total = 0;
        foreach($products as $product)
        {
            $total += $product->price;
        }
        return $total;
    }

    public function addProductInCart($product_id,$user_id)
    {
        $userProduct = $this->products()->find($product_id);
        if(is_null($userProduct))
        {
            $this->products()->attach($product_id);
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
    }

    public function removeProductFromCart($product_id,$user_id)
    {
        $userProduct = $this->products()->find($product_id);

        if($userProduct)
        {
            $amount = DB::table('product_user')
                        ->where('user_id',$user_id)
                        ->where('product_id',$product_id)
                        ->get('amount');
    
            $num = $amount[0]->amount;
            if ($num == 1)
            {
                $this->products()->detach($product_id);
            }
            else
            {
                DB::table('product_user')
                        ->where('user_id',$user_id)
                        ->where('product_id',$product_id)
                        ->decrement('amount', 1);
            }

        }  
    }

}
