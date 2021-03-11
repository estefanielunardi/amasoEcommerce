<?php

namespace App\Repositories\Product;

use App\Repositories\Product\IProductRepository;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Artisan;

class ProductRepository implements IProductRepository
{
    public function getCategory(string $category)
    {
       return Product::whereIn('category', [$category])
            ->with('artisans')->paginate(6);
    }

    public function getAllProducts()
    {
       return Product::whereIn('category', ['vegetales', 'bebidas', 'pasteleria', 'otras'])
            ->with('artisans')->paginate(6);
    }

    public function getBestSeller($id)
    {
       return  Product::whereIn('id', [$id])
                    ->with('artisans')->first();
    }

    public function createNewProduct(Request $request, Artisan  $artisan)
    {
        $product = Product::create([
            'name' => $request->name,
            'image' => $request->image,
            'description' => $request->description,
            'price' => $request->price * 100,
            'typequantity' => $request->typequantity,
            'stock' => $request->stock,
            'sold' => 0,
            'artisan_id' => $artisan->id,
            'category' => $request->category,
            'highlight' => $request->highlight,
        ]);
        $product->save();
        return $product;
    }
    public function deleteProduct($id)
    {
        $product = $this->findProduct($id);
        $product->delete();
    }

    public function findProduct($id)
    {
       return Product::find($id);
    }

    public function updateProduct(Request $request, Product $product)
    {
        $product->image = $request->image;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price * 100;
        $product->stock = $request->stock;
        $product->typequantity = $request->typequantity;
        $product->sold = 0;
        $product->category = $request->category;
        $product->highlight = $request->highlight;

        $product->save();
    }

    public function getOrders($id)
    {
        $orders = DB::table('products')
                            ->where('artisan_id','=', $id)
                            ->join('product_user', 'products.id', '=', 'product_user.product_id') 
                            ->join('users', 'users.id','=', 'product_user.user_id')  
                            ->where('archived','=', 0,'and', 'buyed','=', 1)
                            ->select('product_user.amount', 'users.*','products.*')
                            ->paginate(10);
        return $orders;
    }

    public function getArchivedOrders($id)
    {
        $archivedOrders = DB::table('products')
                            ->where('artisan_id','=', $id)
                            ->join('product_user', 'products.id', '=', 'product_user.product_id') 
                            ->join('users', 'users.id','=', 'product_user.user_id')  
                            ->where('archived','=', 1,'and', 'buyed','=', 1)
                            ->select('product_user.amount', 'users.*','products.*')
                            ->paginate(10);
        return $archivedOrders;
    }

    public function getArtisanProducts($artisan_id)
    {
      $products = DB::table('products')
        ->where('artisan_id', $artisan_id)
        ->paginate(6);
        return $products;
    }

    public function getArtisanHighlightProducts($artisan_id)
    {
        $products = DB::table('products')
        ->where('artisan_id', $artisan_id)
        ->where('highlight', '=', 1)
        ->paginate(3);
        return $products;
    }
    public function findProductByName($name)
    {
       return Product::where('name', 'LIKE', '%' . $name . '%' )
                        ->orWhere ( 'category', 'LIKE', '%' . $name . '%' )
                        ->paginate (6);
    }
}