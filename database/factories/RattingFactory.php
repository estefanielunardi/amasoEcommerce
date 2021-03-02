<?php

namespace Database\Factories;

use App\Models\Ratting;
use Illuminate\Database\Eloquent\Factories\Factory;

class RattingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ratting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'ratting' => $this->faker->numberBetween(1,10),
        ];
    }
}
