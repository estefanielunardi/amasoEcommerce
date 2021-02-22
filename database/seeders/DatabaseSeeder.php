<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Artisan;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        
        User::factory(1)->create([
            'name'=> 'Rosa Maria',
            'email'=> 'rosa@maria',
            'password'=>Hash::make("12345678") ,
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

        Product::factory(5)->create([
            'artisan_id'=>1,
            'image'=> 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1052&q=80',
            'name'=> 'Pan',
            'description'=> 'Pan de campo',
            
        ]);

        User::factory(10)->create();
    }
}
