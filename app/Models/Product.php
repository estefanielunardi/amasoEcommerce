<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'artisan',
        'name',
        'image',
        'description',
        'price',
        'stock',
        'sold',
        'artisan_id',
    ];

    
}
