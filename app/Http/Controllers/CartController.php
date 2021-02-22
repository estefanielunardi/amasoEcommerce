<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;


class CartController extends Controller
{
    public function getProducts()
    {
        $productsCounter = [];
        $id = auth()->id();
        $products = Cart::getProductsInBasket($id);
        foreach ($products as $product) {
            $product_id = $product->id;
            $amountProduct = Cart::getProductAmount($product_id, $id);
            array_push($productsCounter, $amountProduct);
        }
        
        
        $productsCount = array_sum($productsCounter);
        $total = Cart::calculateTotal($products);

        return view('cart.cart', compact("products", "total", "productsCount"));
    }

    public function addProduct($product_id)
    {
        $user_id = auth()->id();
        Cart::addProductInCart($product_id, $user_id);

        return back();            
    }

    public function removeProduct($product_id)
    {
        $user_id = auth()->id();    
        Cart::removeProductFromCart($product_id,$user_id);

        return back();
    }

    public function deleteProduct($product_id)
    {
        $user_id = auth()->id();
        Cart::deleteProductFromCart($product_id, $user_id);

        return back();
    }


}
