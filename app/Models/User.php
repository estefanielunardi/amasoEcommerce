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
        'is_admin'
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
        $products = DB::table('products')
        ->join('product_user', 'products.id', '=', 'product_user.product_id')   
        ->where('user_id','=', $id)
        ->where('buyed', '=', 0)
        ->select('products.*', 'product_user.amount')
        ->get();
    
        return $products;
    }

    public function buyProductsInBasket($user_id){
        $this->decrementStock($user_id);
        
        DB::table('product_user')
            ->where('user_id',$user_id)
            ->update(['buyed' => 1]);
    }

    public function decrementStock($user_id)
    {
        $products = $this->getProductsInBasket($user_id);  
        foreach($products as $product)
        {
            DB::table('products')
                ->where('id',$product->id)
                ->decrement('stock', $product->amount);       

        }
    }

    public function calculateTotal($products)
    {
        $total = 0;
        foreach($products as $product)
        {
            $total += ($product->price * $product->amount)/100;
        }
        return $total;
    }

    public function addProductInCart($product_id,$user_id)
    {
        $userProduct = $this->products()->find($product_id);
        if(is_null($userProduct))
        {
            $this->products()->attach($product_id);
            $this->incrementProductAmount($product_id,$user_id);
        }
        else
        {
            $this->incrementProductAmount($product_id,$user_id);
        }
    }

    public function removeProductFromCart($product_id,$user_id)
    {
        $userProduct = $this->products()->find($product_id);

        if($userProduct)
        {
            $amount = $this->getProductAmount($product_id,$user_id);    
            
            if ($amount == 1)
            {
                $this->products()->detach($product_id);
            }
            else
            {
                $this->decrementProductAmount($product_id,$user_id);
            }
        }  
    }

    public function deleteProductFromCart($product_id)
    {
        $this->products()->detach($product_id);
    
    }

    public function incrementProductAmount($product_id,$user_id)
    {
        DB::table('product_user')
                    ->where('user_id',$user_id)
                    ->where('product_id',$product_id)
                    ->increment('amount', 1);
    } 

    public function decrementProductAmount($product_id,$user_id)
    {
        DB::table('product_user')
            ->where('user_id',$user_id)
            ->where('product_id',$product_id)
            ->decrement('amount', 1);
    }

    private function getProductAmount($product_id,$user_id)
    {
        $amount = DB::table('product_user')
                    ->where('user_id',$user_id)
                    ->where('product_id',$product_id)
                    ->value('amount');
        return $amount;
    }

}
