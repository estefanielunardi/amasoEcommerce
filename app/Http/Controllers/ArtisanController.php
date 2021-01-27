<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artisan; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;

class ArtisanController extends Controller
{
    public function profile(Artisan $artisan) 
    {   
        $products = DB::table('products')
        ->where('artisan_id', $artisan->id)
        ->paginate(3);
        return view('profileArtisan', compact('products', 'artisan'));   
    }

    public function seeProfile() 
    {   
        $artisan = Artisan::getArtisan();
        $products = DB::table('products')
        ->where('artisan_id', $artisan->id)
        ->paginate(3);
        
        return view('profileArtisan', compact('products', 'artisan'));   
    }

    public function store(Request $request){

        $image = '';
        if($request->image)
        {
            $image = $request->file('image')->store('uploads', 'public');
        } 
        else
        {
            $image = 'uploads/default-product.jpeg';
        }    
        $newArtisan = Artisan::create([
            'name' => $request->name,
            'location' =>$request->location,
            'description' =>$request->description,
            'image' => $image, 
            'user_id' =>auth()->id(),
            'slug' => Str::slug($request->name, '-')
            ]);
            
            $newArtisan->save(); 
            
            $artisan = Artisan::getArtisan();

        return redirect('/artisan/' .  $artisan->slug);
    }

    public function getAll(){

        $artisans = DB::table('artisans')
                    ->paginate(6);
        return view('artisans', compact('artisans'));
    }

    public function destroy()
    {
        $artisan = Artisan::getArtisan();
        $artisan->delete();

        return redirect('/');
    }

    public function edit()
    {
       $artisan = Artisan::getArtisan();

        return view('editArtisan', compact('artisan'));
    }

    public function update(Request $request , Artisan $artisan)
    {
        $image = '';
        if($request->image)
        {
            $image = $request->file('image')->store('uploads', 'public');
        } 
        else
        {
            $image = 'uploads/default-product.jpeg';
        }    
        $artisan->name = $request->name;
        $artisan->location = $request->location;
        $artisan->description = $request->description;
        $artisan->image  = $image;
        $artisan->user_id =auth()->id();
        $artisan->slug =Str::slug($request->name, '-');

        $artisan->save();
            
        return redirect('/artisan/' . $artisan->slug);
    }

}
