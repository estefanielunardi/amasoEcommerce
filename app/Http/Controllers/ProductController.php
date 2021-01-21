<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Artisan;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products= DB::table("products")->paginate(6);
        
        
        return view('welcome', compact("products"));
    }

    public function store(Request $request)
    {
        $artisan_id= auth()->id();
        $artisan= Artisan::find($artisan_id);
      
        
        $product= Product::create([
            'artisan'=>$artisan->name,
            'name'=>$request->name,
            'image'=>$request->image,
            'description'=>$request->description,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'sold'=>0,
            'artisan_id'=>$artisan_id,
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

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request , Product $product)
    {
        $product->artisan = $request->artisan;
        $product->name = $request->name;
        $product->image = $request->image;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = $request->sold;

        $product->save();

        return redirect('profileArtisan');
    }
}
