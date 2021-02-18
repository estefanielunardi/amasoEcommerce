<?php

namespace App\src\Product\Aplication;


class CreateProductRequest
{
    private string $name;
    private string $description;
    private int $price;
    private int $stock;
    private int $sold;
    private int $artisan_id;

    public function __construct(string $name, int $price, string $description, int $stock, int $sold, int $artisan_id)
    {
        
    }
    
}