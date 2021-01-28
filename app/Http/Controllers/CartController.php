<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;


class CartController extends Controller
{
    public function getProducts()
    {
        $products= Product::with('artisans')->paginate(6);
        
        return view('cart', compact("products"));
    }

  

    public function addProducts($id)
        {

            $product = Product::find($id);
            $id = auth()->id();
            $user = User::find($id); 
            $user->products()->attach($id);
            
        }
    

    }
