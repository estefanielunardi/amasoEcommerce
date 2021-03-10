<?php

namespace App\Repositories\Cart;

interface ICartRepository 
{
    public function getProductsInBasket($id);
    public function calculateTotal($products);
    public function addProductInCart($product_id, $user_id);
    public function incrementProductAmount($product_id, $user_id);
    public function removeProductFromCart($product_id, $user_id);
    public function deleteProductFromCart($product_id, $user_id);
    public function getPurchasedProducts($id);
    public function buyProductsInBasket($user_id);
    public function getBestSellersIds();
    public function deleteAllProductsFromCart($user_id);
    public function getProductAmountInBasket($product_id,  $user_id);
    public function archiveOrder($id);
    public function getProductsIdsWhereUserId($id);
}