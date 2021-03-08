<?php

namespace App\Repositories\Product;

interface IProductRepository 
{
    public function getCategory($category);
    public function getAllProducts();
    public function getBestSeller($id);
    public function createNewProduct($request, $artisan);
    public function deleteProduct($id);
    public function findProduct($id);
    public function updateProduct($request, $product);
    public function getOrders($id);
    public function getArchivedOrders($id);
    public function getArtisanProducts($artisan_id);
    public function getArtisanHighlightProducts($artisan_id);
    public function findProductByName($name);
}