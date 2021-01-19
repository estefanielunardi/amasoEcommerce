<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Artisan;

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

        Artisan::factory(1)->create([
            'name'=>'Juan Froilan de Todos los Santos',
            'email'=>'juanfroilan@santos', 
            'password'=>'12345678',
            'location'=>'Igualada, Barcelona',
            'image'=>'https://i.ibb.co/tBsVJMH/n-UFXna-Qq-400x400.jpg'
        ]);
    }
}
