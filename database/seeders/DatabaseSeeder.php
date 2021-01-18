<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        Product::factory(10)->create();
    }
}
