<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use App\Repositories\Cart\ICartRepository;
use App\Repositories\Artisan\IArtisanRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Rating\RatingRepository;
use App\Services\DateService\DateService;


class ProductController extends Controller
{
    private ICartRepository $cartRepo;
    private IArtisanRepository $artisanRepo;
    private ProductRepository $productRepo;
    private RatingRepository $ratingRepo;
    private DateService $dateService;

    public function __construct(ICartRepository $cartRepo, IArtisanRepository $artisanRepo)
    {
        $this->cartRepo = $cartRepo;
        $this->productRepo = new ProductRepository;
        $this->artisanRepo = $artisanRepo;
        $this->ratingRepo = new RatingRepository;
        $this->dateService = new DateService;
    }

    public function getProducts()
    {
        $products = $this->productRepo->getAllProducts();
        $ids = $this->cartRepo->getBestSellersIds();

        $monthName = $this->dateService->getMonthName();

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
        $user_id = auth()->id();
        $artisan = $this->artisanRepo->getArtisan($user_id);

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
        $user_id = auth()->id();
        $artisan = $this->artisanRepo->getArtisan($user_id);

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
        $user_id = auth()->id();
        $artisan = $this->artisanRepo->getArtisan($user_id);
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
        $rattings = $this->ratingRepo->findAllRatings( $id );
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
            $midRate = 0;
            $votesCount = 0;
            return view('products.productPage', compact('product', 'comments', 'replies', 'midRate', 'votesCount'));
    }

    public function search(Request $request)
    {
        $name = $request->search;
        $products =   $this->productRepo->findProductByName($name);
        if (count($products) !== 0) {
            return view('products.searchedProduct', compact('products', 'name'));
        } else {
            return back() ->with('message' , 'No se han encontrado resultados a su búsqueda');
        }
    }
}
