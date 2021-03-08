<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Artisan;
use App\Models\Comment;
use App\Models\Ratting;
use Carbon\Carbon;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Product\ProductRepository;

class ProductController extends Controller
{
    private CartRepository $cartRepo;

    public function __construct()
    {
        $this->cartRepo = new CartRepository;
        $this->productRepo = new ProductRepository;
    }

    public function getProducts()
    {
        $products = $this->productRepo->getAllProducts();
        $ids = $this->cartRepo->getBestSellersIds();

        $monthName = Carbon::now()->monthName;
        
        $bestSellers = [];
        if ($ids) {
            foreach ($ids as $id) {
                $best = $this->productRepo->getBestSeller($id);
                array_push($bestSellers, $best);
            }
            return view('welcome', compact("products", "bestSellers", "monthName"));
        }
        return view('welcome', compact("products"));
    }

    public function getCategory($category)
    {
        $products = $this->productRepo->getCategory($category);
        
        return view('welcome', compact("products"));
    }
    
    public function store(Request $request)
    {
        $artisan = Artisan::getArtisan();

        $product = $this->productRepo->createNewProduct($request, $artisan);
        
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

        $this->productRepo->deleteProduct($id);

        return redirect('/artisan/' . $artisan->slug);
    }

    public function edit($id)
    {
        $product = $this->productRepo->findProduct($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $artisan = Artisan::getArtisan();
        $this->productRepo->updateProduct($request, $product);
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

        $product = $this->productRepo->findProduct($id);
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
            $emptyStars =  5 - $midRate;
        
            return view('products.productPage', compact('product', 'comments', 'replies', 'midRate','emptyStars', 'votesCount'));
        } else


            return view('products.productPage', compact('product', 'comments', 'replies'));
    }
}
