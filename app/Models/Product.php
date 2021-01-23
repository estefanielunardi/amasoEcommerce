<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'stock',
        'sold',
        'artisan_id',
    ];

    public function artisans()
    {
        return $this->belongsTo(Artisan::class, 'artisan_id');
    }

    
}
