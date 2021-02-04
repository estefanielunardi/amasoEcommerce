<?php

namespace App\Http\Controllers;
use App\Models\User;


class CartController extends Controller
{
    public function getProducts()
    {
        $id = auth()->id();
        $user = User::find($id);
        $products = $user->getProductsInBasket($id);
        $total = $user->calculateTotal($products);

        return view('cart.cart', compact("products", "total"));
    }

    public function addProduct($product_id)
    {
        $user_id = auth()->id();
        $user = User::find($user_id); 
        $user->addProductInCart($product_id, $user_id);

        return back();            
    }

    public function removeProduct($product_id)
    {
        $user_id = auth()->id();
        $user = User::find($user_id); 
        $user->removeProductFromCart($product_id,$user_id);

        return back();
    }

    public function deleteProduct($product_id)
    {
        $user_id = auth()->id();
        $user = User::find($user_id); 
        $user->deleteProductFromCart($product_id);

        return back();
    }


}
