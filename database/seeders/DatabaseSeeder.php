<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Artisan;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Allergen;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        
        User::factory(1)->create([
            'name'=> 'Rosa Maria',
            'email'=> 'rosa@maria',
            'password'=>Hash::make("12345678"),
            'isArtisan'=>true,
        ]);
       
        Artisan::factory(1)->create([
         
            'user_id'=>1,
            'name'=>'Rosa Maria',
            'slug'=>Str::slug('Rosa Maria', '-'),
            'description' => 'Una artesana de corazon',
            'location'=>'Montserrat, Barcelona',
            'image'=>'https://i.ibb.co/g7RZC31/edward-cisneros-H6wpor9mjs-unsplash.jpg',
            'aproved'=>'1',
        ]);

        Product::factory(1)->create([
            'artisan_id'=>1,
            'image'=> 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1052&q=80',
            'name'=> 'Pan',
            'price' => 125,
            'typequantity' => 'Unidad',
            'description'=> 'Pan de campo',
            'stock'=> 10,
            'sold' => 0,  
        ]);

        Product::factory(1)->create([
            'artisan_id'=>1,
            'image'=> 'https://images.unsplash.com/photo-1426869884541-df7117556757?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80',
            'name'=> 'Cupcakes',
            'price' => 625,
            'typequantity' => 'Media Docena',
            'description'=> 'Cupcakes con crema',
            'stock'=> 10,
            'sold' => 0,  
        ]);

        Product::factory(1)->create([
            'artisan_id'=>1,
            'image'=> 'https://images.unsplash.com/photo-1587244141530-6b6aceef93db?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80',
            'name'=> 'Fresas',
            'price' => 745,
            'typequantity' => 'Kg',
            'description'=> 'Fresas dulces',
            'stock'=> 10,
            'sold' => 0,  
        ]);

        Product::factory(1)->create([
            'artisan_id'=>1,
            'image'=> 'https://images.unsplash.com/photo-1513088222195-4388e0a0c553?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1053&q=80',
            'name'=> 'Mermelada',
            'price' => 425,
            'typequantity' => 'Unidad',
            'description'=> 'Mermelada deliciosa',
            'stock'=> 10,
            'sold' => 0,  
        ]);

        Product::factory(1)->create([
            'artisan_id'=>1,
            'image'=> 'https://images.unsplash.com/photo-1496318447583-f524534e9ce1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1105&q=80',
            'name'=> 'Zumo',
            'price' => 555,
            'typequantity' => 'Litro',
            'description'=> 'Zumo natural',
            'stock'=> 10,
            'sold' => 0,  
        ]);

        User::factory(1)->create([
            'name'=> 'Tortus',
            'email'=>'tortus@tortus',
            'password'=>Hash::make("12345678")
        ]);

        Allergen::factory(1)->create([
            'type'=> 'Sin Gluten',
        ]);

        Allergen::factory(1)->create([
            'type'=> 'Sin Lactosa',
        ]);

        Allergen::factory(1)->create([
            'type'=> 'Sin Huevo',
        ]);

        Allergen::factory(1)->create([
            'type'=> 'Sin Frutos de Cáscara',
        ]);

        Allergen::factory(1)->create([
            'type'=> 'Sin Cacahuete',
        ]);

        Allergen::factory(1)->create([
            'type'=> 'Sin Soja',
        ]);

        Allergen::factory(1)->create([
            'type'=> 'Sin Mariscos',
        ]);
    }
}
