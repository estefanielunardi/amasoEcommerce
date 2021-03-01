<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;


class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function artisans()
    {
        return $this->belongsTo(Artisan::class, 'artisan_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public static function decrementStock($user_id)
    {
        $products = Cart::getProductsInBasket($user_id);  
        foreach($products as $product)
        {
            DB::table('products')
                ->where('id',$product->id)
                ->decrement('stock', $product->amount);       

        }
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function rattings()
    {
        return $this->hasMany(Ratting::class);
    }
}
