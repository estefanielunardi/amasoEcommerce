<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


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
