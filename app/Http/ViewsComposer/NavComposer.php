<?php

namespace App\Http\ViewsComposer;


use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Models\Cart;

class NavComposer{

    public function compose(View $view){
        
        $productsCounter = [];
        $id = auth()->id();
        $products = Cart::getProductsInBasket($id);
        foreach ($products as $product) {
            $product_id = $product->id;
            $amountProduct = Cart::getProductAmount($product_id, $id);
            array_push($productsCounter, $amountProduct);
        }
        $productsCount = array_sum($productsCounter);
        
        $view->with('productsCount', $productsCount);
        
        
    }

}