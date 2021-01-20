<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products= DB::table("products")->paginate(6);
        
        return view('welcome', compact("products"));
    }

    public function store(Request $request)
    {
        $product= Product::create([
            'artisan'=>$request->artisan,
            'name'=>$request->name,
            'image'=>$request->image,
            'description'=>$request->description,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'sold'=>$request->sold,
            'artisan_id'=>$request->artisan_id,
        ]);

        $product->save();
        return redirect('profileArtisan');

    }

    public function destroy($id)
    {
        $product= Product::find($id);
        $product->delete();

        return redirect('profileArtisan');
    }
}
