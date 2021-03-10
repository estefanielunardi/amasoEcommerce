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

        if (count($activeProduct) == 0) {
            $user = User::find($user_id);
            $user->products()->attach($product_id);
            $this->incrementProductAmount($product_id, $user_id);
        } else {
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
        $this->decrementStock($user_id);

        DB::transaction(function () use ($user_id) {
            DB::table('product_user')
                ->where('user_id', $user_id)
                ->update(['buyed' => 1, 'updated_at' => Carbon::now()]);
        });
    }

    private function decrementStock($user_id)
    {
        $products = $this->getProductsInBasket($user_id);
        foreach ($products as $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->decrement('stock', $product->amount);
        }
    }

    public function getBestSellersIds()
    {
        $startMonth = Carbon::now()->startOfMonth();
        $now = Carbon::now();
        $buyed = DB::table('product_user')
            ->where(['buyed' => 1])
            ->whereBetween('updated_at', [$startMonth, $now])
            ->get(['amount', 'product_id']);

        if (count($buyed) > 0) {
            $ids = $this->findBestSeller($buyed);
            return $ids;
        };
    }

    private function findBestSeller($buyed)
    {
        $resultDict = [];
        foreach ($buyed as $item) {
            $amount = 0;
            $equals = $this->findEqual($buyed, $item->product_id);
            foreach ($equals as $item) {
                $amount += $item->amount;
            }
            $resultDict[$item->product_id] = ['amount' => $amount, 'id' => $item->product_id];
        }
        $ids = $this->sortSoldAmount($resultDict);
        return $ids;
    }

    private function findEqual($products, $id)
    {
        $equals = [];
        foreach ($products as $product) {
            if ($product->product_id == $id) {
                array_push($equals, $product);
            }
        }
        return $equals;
    }

    private function sortSoldAmount($resultDict)
    {
        $result = [];
        foreach ($resultDict as $item) {
            array_push($result, $item);
        }
        usort($result, function ($a, $b) {
            return $b['amount'] - $a['amount'];
        });
        $ids = [];

        $i = 0;
        while ($i < count($result) && $i < 3) {
            array_push($ids, $result[$i]['id']);
            $i++;
        }
        return $ids;
    }

    public function deleteAllProductsFromCart($user_id)
    {
        DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('buyed', 0)
            ->delete();
    }

    public function getProductAmountInBasket($product_id,  $user_id)
    {
        $amount = DB::table('product_user')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('buyed', '=', 0)
            ->value('amount');
        return $amount;
    }

    public function archiveOrder($id)
    {
        DB::table('product_user')
            ->where('id', '=', $id)
            ->update(['archived' => 1]);
    }

    public function getProductsIdsWhereUserId($id)
    {
      return  DB::table('product_user')
            ->where('user_id', '=', $id)
            ->where('buyed', true)
            ->orderByDesc('updated_at')
            ->get('product_id');
    }
}
