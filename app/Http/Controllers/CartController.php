<?php

namespace App\Http\Controllers;
use App\Repositories\Cart\ICartRepository;
use App\Repositories\User\UserRepository;

class CartController extends Controller
{
    private ICartRepository $cartRepo;

    public function __construct(ICartRepository $cartRepo)
    {
        $this->cartRepo = $cartRepo;
        $this->userRepo = new UserRepository;
    }

    public function getProducts()
    {
        $productsCounter = [];
        $id = auth()->id();       
        $products = $this->cartRepo->getProductsInBasket($id);
        $total = $this->cartRepo->calculateTotal($products);

        return view('cart.cart', compact("products", "total"));
    }

    public function addProduct($product_id)
    {
        $user_id = auth()->id();
        $user = $this->userRepo->getUserById($user_id);
        $this->cartRepo->addProductInCart($product_id, $user);

        return back();            
    }

    public function incrementAmount($product_id)
    {
        $user_id = auth()->id();
        $this->cartRepo->incrementProductAmount($product_id, $user_id);

        return back();            
    }

    public function removeProduct($product_id)
    {
        $user_id = auth()->id();  
        $user = $this->userRepo->getUserById($user_id);  
        $this->cartRepo->removeProductFromCart($product_id,$user);

        return back();
    }

    public function deleteProduct($product_id)
    {
        $user_id = auth()->id();
        $this->cartRepo->deleteProductFromCart($product_id, $user_id);

        return back();
    }

    public function deleteAllProducts() 
    {
        $user_id = auth()->id();
        $this->cartRepo->deleteAllProductsFromCart($user_id);

        return back();
    }

}
