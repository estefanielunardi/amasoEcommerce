<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artisan; 
use Illuminate\Support\Facades\DB; 

class ArtisanController extends Controller
{
    public function profile(Artisan $artisan) 
    {   
        $products = DB::table('products')
        ->where('artisan_id', $artisan->id)
        ->paginate(3);
        return view('profileArtisan', compact('products', 'artisan'));   
    }

    public function joinUs(){
        return view('joinArtisan');
    }

    public function store(Request $request){
        $newArtisan = Artisan::create([
            'name' => $request->name,
            'location' =>$request->location,
            'description' =>$request->description,
            'image' =>$request->image, 
            'user_id' =>auth()->id(),
            'slug' =>$request->name
            ]);
            
            $newArtisan->save(); 
            
        $id = auth()->id();
        $artisan = DB::table('artisans')->where('user_id', $id)->first();

        return redirect('/artisan/' .  $artisan->slug);
    }

    public function getAll(){

        $artisans = DB::table('artisans')
                    ->paginate(6);
        return view('artisans', compact('artisans'));
    }

    public function destroy()
    {
        $id = auth()->id();
        $artisan = Artisan::find($id)->first();
        $artisan->delete();

        return redirect('/');
    }

    public function edit($id)
    {
        $artisan = Artisan::find($id)->first();

        return view('editArtisan', compact('artisan'));
    }

    public function update(Request $request , Artisan $artisan)
    {
        $artisan->name = $request->name;
        $artisan->location = $request->location;
        $artisan->description = $request->description;
        $artisan->image  = $request->image;
        $artisan->user_id =auth()->id();
        $artisan->slug = $request->name;

        $artisan->save();
            
        return redirect('/artisan/' . $artisan->slug);
    }

}
