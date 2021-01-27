<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Artisan;
use App\Models\User;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::with('artisans')->paginate(6);
        return view('welcome', compact("products"));
    }

    public function store(Request $request)
    {
        $id = auth()->id();
        $artisan = DB::table('artisans')->where('user_id', $id)->first();

        $product= Product::create([
            'name'=>$request->name,
            'image'=> $request->file('image')->store('uploads', 'public'),
            'description'=>$request->description,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'sold'=> 0,
            'artisan_id'=>$artisan->id,
        ]);

        $product->save();
        return redirect('/artisan/' .  $artisan->slug);

    }

    public function destroy($id)
    {
        $artisanId = auth()->id();
        $artisan = DB::table('artisans')->where('user_id', $artisanId)->first();

        $product= Product::find($id);
        $product->delete();

        return redirect('/artisan/' . $artisan->slug);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request , Product $product)
    {
        $id = auth()->id();
        $artisan = DB::table('artisans')->where('user_id', $id)->first();

        $product->name = $request->name;
        $product->image = $request->image;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sold = 0;

        $product->save();

        return redirect('/artisan/' .  $artisan->slug);
    }
}
