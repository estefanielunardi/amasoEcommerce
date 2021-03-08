<?php

namespace App\Repositories\Product;

use App\Repositories\Product\IProductRepository;
use App\Models\Product;

class ProductRepository implements IProductRepository
{
    public function getCategory($category)
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

    public function createNewProduct($request, $artisan)
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

    public function updateProduct($request, $product)
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
}