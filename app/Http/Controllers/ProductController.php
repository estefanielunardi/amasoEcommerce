<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Artisan;
use App\Models\Comment;
use App\Models\Ratting;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::whereIn('category', ['vegetales', 'bebidas', 'pasteleria', 'otras'])
            ->with('artisans')->paginate(6);
        $ids = Cart::getBestSellersIds();

        $monthName = Carbon::now()->monthName;
        
        $bestSellers = [];
        if ($ids) {
            foreach ($ids as $id) {
                $best = Product::whereIn('id', [$id])
                    ->with('artisans')->first();
                array_push($bestSellers, $best);
            }
            return view('welcome', compact("products", "bestSellers", "monthName"));
        }
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

    public function getOthersProducts()
    {
        $products = Product::whereIn('category', ['otras'])
            ->with('artisans')->paginate(6);
        return view('welcome', compact("products"));
    }

    public function store(Request $request)
    {

        $artisan = Artisan::getArtisan();

        $product = Product::create([
            'name' => $request->name,
            'image' => $request->image,
            'description' => $request->description,
            'price' => $request->price * 100,
            'typequantity' => $request->typequantity,
            'stock' => $request->stock,
            'sold' => 0,
            'artisan_id' => $artisan->id,
            'category' => $request->category,
            'highlight' => $request->highlight,
        ]);

        $product->save();


        $listAllergens = [];
        $data = $request->all();

        foreach ($data as $key => $value) {
            if (str_starts_with($key, "Sin")) {
                array_push($listAllergens, [$key => $value]);
            }
        }


        for ($i = 0; $i < count($listAllergens); $i++) {
            foreach ($listAllergens[$i] as $key => $value) {
                $product->allergens()->attach($value);
            }
        }

        return redirect('/artisan/' .  $artisan->slug);
    }

    public function destroy($id)
    {
        $artisan = Artisan::getArtisan();

        $product = Product::find($id);
        $product->delete();

        return redirect('/artisan/' . $artisan->slug);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $artisan = Artisan::getArtisan();

        $product->image = $request->image;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price * 100;
        $product->stock = $request->stock;
        $product->typequantity = $request->typequantity;
        $product->sold = 0;
        $product->category = $request->category;
        $product->highlight = $request->highlight;

        $product->save();

        $product->allergens()->detach();
        $listAllergens = [];
        $data = $request->all();

        foreach ($data as $key => $value) {
            if (str_starts_with($key, "Sin")) {
                array_push($listAllergens, [$key => $value]);
            }
        }


        for ($i = 0; $i < count($listAllergens); $i++) {
            foreach ($listAllergens[$i] as $key => $value) {
                $product->allergens()->attach($value);
            }
        }

        return redirect('/artisan/' .  $artisan->slug);
    }

    public function showProduct($id)
    {

        $product = Product::find($id);
        $comments = Comment::whereIn('commentable_id', [$id])
            ->where('parent_id', null)
            ->with('user')
            ->paginate(6);

        $replies = Comment::whereIn('commentable_id', [$id])
            ->where('parent_id', '!=', null)
            ->with('user')
            ->get();

        $rattingsSum = [];
        $rattings = Ratting::where('product_id', [$id])->get();
        if (count($rattings) != 0) {
            foreach ($rattings as $ratting) {
                array_push($rattingsSum, $ratting->ratting);
            }
            $votesCount = count($rattingsSum);
            $totalRate = array_sum($rattingsSum);
            $midRate = strval($totalRate / count($rattingsSum));
            $midRate = round($midRate, 0, PHP_ROUND_HALF_DOWN);
            return view('products.productPage', compact('product', 'comments', 'replies', 'midRate', 'votesCount'));
        } else


            return view('products.productPage', compact('product', 'comments', 'replies'));
    }
}
