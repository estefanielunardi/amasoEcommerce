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
        $products = Product::whereIn('category', ['vegetales', 'bebidas', 'pasteleria'])
                ->with('artisans')->paginate(6);
        return view('welcome', compact("products"));
    }

    public function getVegetablesProducts()
    {
        $products = Product::whereIn('category', ['vegetales'])
                ->with('artisans')->paginate(6);
        return view('welcome', compact("products"));
    }

    public function getDrinkProducts()
    {
        $products = Product::whereIn('category', ['bebidas'])
                ->with('artisans')->paginate(6);
        return view('welcome', compact("products"));
    }

    public function getBakeryProducts()
    {
        $products = Product::whereIn('category', ['pasteleria'])
                ->with('artisans')->paginate(6);        
        return view('welcome', compact("products"));
    }

    public function store(Request $request)
    {
        $artisan = Artisan::getArtisan();

        $image = $this->setImage($request);

        $product= Product::create([
            'name'=>$request->name,
            'image'=> $image,
            'description'=>$request->description,
            'price'=>$request->price * 100,
            'stock'=>$request->stock,
            'sold'=> 0,
            'artisan_id'=>$artisan->id,
            'category'=>$request->category,
        ]);

        $product->save();
        return redirect('/artisan/' .  $artisan->slug);

    }

    public function destroy($id)
    {   
        $artisan = Artisan::getArtisan();

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
        $artisan = Artisan::getArtisan();
        $image = $this->setImage($request);

        $product->image = $image;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price*100;
        $product->stock = $request->stock;
        $product->sold = 0;
        $product->category = $request->category;


        $product->save();

        return redirect('/artisan/' .  $artisan->slug);
    }

    private function setImage($request)
    {
        $image = '';
        if($request->image)
        {
             $image = $request->file('image')->store('uploads', 'public');
        } 
        else
        {
             $image = 'uploads/amaso.png';
        }  
        return $image;  
    }

}
