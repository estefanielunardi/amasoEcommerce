<?php

namespace App\src\Product\Domain\Contracts;


Interface IProductRepository 
{   
    public function create(array $product);
}