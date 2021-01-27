<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class CartController extends Controller
{
    public function getProducts()
    {
        $products= Product::with('artisans')->paginate(6);
        
        return view('cart', compact("products"));
    }

}
