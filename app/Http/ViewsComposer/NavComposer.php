<?php

namespace App\Http\ViewsComposer;


use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Models\Cart;
use App\Repositories\Cart\CartRepository;

class NavComposer
{
    private CartRepository $cartRepo;

    public function __construct()
    {
        $this->cartRepo = new CartRepository;
    }

    public function compose(View $view){
        
        $productsCounter = [];
        $id = auth()->id();
        $products =  $this->cartRepo->getProductsInBasket($id);
        foreach ($products as $product) {
            $product_id = $product->id;
            $amountProduct = $this->cartRepo->getProductAmountInBasket($product_id, $id);
            array_push($productsCounter, $amountProduct);
        }
        $productsCount = array_sum($productsCounter);
        
        $view->with('productsCount', $productsCount);
        
        
    }

}