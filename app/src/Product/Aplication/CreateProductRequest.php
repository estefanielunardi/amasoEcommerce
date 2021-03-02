<?php

namespace App\src\Product\Aplication;


class CreateProductRequest
{
    private string $name;
    private string $description;
    private int $price;
    private int $stock;
    private int $artisan_id;

    public function __construct(string $name, int $price, string $description, int $stock, int $artisan_id)
    {   
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->stock = $stock;
        $this->artisan_id = $artisan_id;
        
    }

    public function getName()
    {
        return $this->name;

    }

    
}