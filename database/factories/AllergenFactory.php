<?php

namespace Database\Factories;

use App\Models\Allergen;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllergenFactory extends Factory
{
    
    protected $model = Allergen::class;

    public function definition()
    {
        return [
            'type' => $this->faker->word(),
        ];
    }
}
