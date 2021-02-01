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
        
}
        
        
        


