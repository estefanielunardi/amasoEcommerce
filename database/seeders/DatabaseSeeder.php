<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Artisan;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        Product::factory(5)->create([
            'image'=> 'https://i.ibb.co/1TF2Z1R/840-560.jpg',
            'name'=> 'Pan de Campo',
            'description'=> 'Pan fresco elaborado con las mejores materias primas',
            'artisan_id' => 1
        ]);

        Product::factory(5)->create([
            'image'=> 'https://i.ibb.co/Hn1CmjH/Mermelada-de-fresa-2.jpg',
            'name'=> 'Mermelada de Fresa',
            'description'=> 'Mermelada de fresa elaborada con las mejores materias primas',
            'artisan_id' => 2
        ]);


        Artisan::factory(1)->create([
            'name'=>'Juan Froilan de Todos los Santos',
            'slug'=>Str::slug('Juan Froilan de Todos los Santos','-'),
            'email'=>'juanfroilan@santos', 
            'password'=>'12345678',
            'location'=>'Igualada, Barcelona',
            'image'=>'https://i.ibb.co/tBsVJMH/n-UFXna-Qq-400x400.jpg'
        ]);

        Artisan::factory(1)->create([
            'name'=>'Rosa Maria',
            'slug'=>Str::slug('Rosa Maria', '-'),
            'email'=>'rosa@maria', 
            'password'=>'12345678',
            'location'=>'Montserrat, Barcelona',
            'image'=>'https://i.ibb.co/g7RZC31/edward-cisneros-H6wpor9mjs-unsplash.jpg'
        ]);
    }
}
