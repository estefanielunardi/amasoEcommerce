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

  

    public function addProducts(request $request)
        {
            $product= Product::find($request->product_id);
            
            Cart::add(
                $product->id,
                $product->name,
                $product->price,
                1,
                array("urlphoto=>$product->urlphoto")
            );

            return back()->with('success',"$product->name ¡se ha agregado con éxito al carrito!");
        }
    

    }