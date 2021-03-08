<?php

namespace App\Repositories\Cart;

use Illuminate\Support\Facades\DB;
use App\Repositories\Cart\ICartRepository;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

class CartRepository implements ICartRepository
{
    public function getProductsInBasket($id)
    {
        $products = DB::table('products')
        ->join('product_user', 'products.id', '=', 'product_user.product_id')
        ->where('user_id', '=', $id)
        ->where('buyed', '=', 0)
        ->select('products.*', 'product_user.amount')
        ->get();

        return $products;
    }
    public function calculateTotal($products)
    {
        $total = 0;
        foreach ($products as $product) {
            $total += ($product->price * $product->amount) / 100;
        }
        return $total;
    }
    private function findActiveProduct($product_id, $user_id)
    {
        $activeProduct = DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('buyed', 0)
            ->get();
        return $activeProduct;
    }

    public function incrementProductAmount($product_id, $user_id)
    {
        DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('buyed', 0)
            ->increment('amount', 1);
    }


    public function addProductInCart($product_id, $user_id)
    {
        $activeProduct = $this->findActiveProduct($product_id, $user_id);
        
        if (count($activeProduct) == 0) 
        {
            $user = User::find($user_id);
            $user->products()->attach($product_id);
            $this->incrementProductAmount($product_id, $user_id);
        } 
        else
        {
            $this->incrementProductAmount($product_id, $user_id);
        }
    }

    private function decrementProductAmount($product_id, $user_id)
    {
        DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->decrement('amount', 1);
    }

    private function getProductAmount($product_id, $user_id)
    {
        $amount = DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->value('amount');
        return $amount;
    }


    public function removeProductFromCart($product_id, $user_id)
    {
        $user = User::find($user_id);
        $userProduct = $user->products()->find($product_id);

        if ($userProduct) {
            $amount = $this->getProductAmount($product_id, $user_id);

            if ($amount <= 1) {
                $user->products()->detach($product_id);
            } else {
                $this->decrementProductAmount($product_id, $user_id);
            }
        }
    }

    public function deleteProductFromCart($product_id, $user_id)
    {
        DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('buyed', 0)
            ->delete();
    }

    public function getPurchasedProducts($id)
    {
        $products = DB::table('products')
            ->join('product_user', 'products.id', '=', 'product_user.product_id')
            ->where('user_id', '=', $id)
            ->where('buyed', '=', 1)
            ->select('products.*', 'product_user.amount')
            ->get();

        return $products;
    }

    public function buyProductsInBasket($user_id)
    {
        Product::decrementStock($user_id);

        DB::transaction(function () use ($user_id) {
            DB::table('product_user')
                ->where('user_id', $user_id)
                ->update(['buyed' => 1, 'updated_at' => Carbon::now()]);
            });
    }
}