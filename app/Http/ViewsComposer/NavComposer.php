<?php

namespace App\Http\ViewsComposer;

use Illuminate\Contracts\View\View;
use App\Repositories\Cart\ICartRepository;

class NavComposer
{
    private ICartRepository $cartRepo;

    public function __construct(ICartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
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