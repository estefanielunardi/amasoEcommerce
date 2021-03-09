<?php

namespace App\Repositories\Product;
use Illuminate\Http\Request;
use App\Models\Artisan;
use App\Models\Product;

interface IProductRepository 
{
    public function getCategory(string $category);
    public function getAllProducts();
    public function getBestSeller($id);
    public function createNewProduct(Request $request, Artisan $artisan);
    public function deleteProduct($id);
    public function findProduct($id);
    public function updateProduct(Request $request, Product $product);
    public function getOrders($id);
    public function getArchivedOrders($id);
    public function getArtisanProducts($artisan_id);
    public function getArtisanHighlightProducts($artisan_id);
    public function findProductByName($name);
}