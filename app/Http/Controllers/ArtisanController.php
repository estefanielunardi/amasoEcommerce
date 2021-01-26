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

        Artisan::create($request->all());
        return back();
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

}
