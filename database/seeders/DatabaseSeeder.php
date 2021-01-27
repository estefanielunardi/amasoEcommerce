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
            'image'=>'https://i.ibb.co/g7RZC31/edward-cisneros-H6wpor9mjs-unsplash.jpg'
        ]);

        Product::factory(5)->create([
            'artisan_id'=>1,
            'image'=> 'uploads/8Q8qn1T92X929f4uDmlk34lwpRXGKk1GNQ2z5wJC.jpg',
            'name'=> 'Mermelada de Fresa',
            'description'=> 'Mermelada de fresa elaborada con las mejores materias primas',
            
        ]);
    }
}
