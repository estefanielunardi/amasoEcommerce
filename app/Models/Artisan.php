<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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
        $artisan_id = DB::table('artisans')->where('user_id', $user_id)->get(['id']);    
        $id = $artisan_id[0]->id;    
        $artisan = Artisan::find($id);
        
        return $artisan;
    }

}
