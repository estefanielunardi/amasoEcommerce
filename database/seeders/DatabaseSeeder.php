<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        Product::factory(10)->create([
            'image'=> './image/pan.jpeg',
            'name'=> 'Pan de Campo',
            'artisan'=> 'Juana Mercedes',
            'description'=> 'Pan fresco elaborado con las mejores materias primas'
        ]);
    }
}
