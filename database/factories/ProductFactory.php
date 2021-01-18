<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    
    protected $model = Product::class;

    
    public function definition()
    {
        return [
            'artisan'=> $this->faker->name,
            'name' => $this->faker->word(),
            'image' => $this->faker->sentence,
            'description' => $this->faker->text,
            'price' =>$this->faker->numberBetween(0,100),
            'stock' =>$this->faker->numberBetween(0,100),
            'sold' =>$this->faker->numberBetween(0,100),
        ];
    }
}
