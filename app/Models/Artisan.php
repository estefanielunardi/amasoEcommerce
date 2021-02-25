<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class Artisan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
       return $this->hasOne(User::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function getArtisan()
    {
        $user_id = auth()->id();
        $artisan_id = DB::table('artisans')->where('user_id', $user_id)->value('id');
        $artisan = Artisan::find($artisan_id);
        return $artisan;
    }

    public function getOrders($id)
    {
        $orders = DB::table('products')
                            ->where('artisan_id','=', $id)
                            ->join('product_user', 'products.id', '=', 'product_user.product_id') 
                            ->join('users', 'users.id','=', 'product_user.user_id')  
                            ->where('archived','=', 0,'and', 'buyed','=', 1)
                            ->select('product_user.amount', 'users.*','products.*')
                            ->paginate(10);
        return $orders;
    }

    public function getArchivedOrders($id)
    {
        $archivedOrders = DB::table('products')
                            ->where('artisan_id','=', $id)
                            ->join('product_user', 'products.id', '=', 'product_user.product_id') 
                            ->join('users', 'users.id','=', 'product_user.user_id')  
                            ->where('archived','=', 1,'and', 'buyed','=', 1)
                            ->select('product_user.amount', 'users.*','products.*')
                            ->paginate(10);
        return $archivedOrders;
    }
        
}
        
        
        


