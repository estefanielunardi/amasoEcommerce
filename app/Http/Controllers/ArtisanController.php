<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artisan; 
use Illuminate\Support\Facades\DB; 

class ArtisanController extends Controller
{
    public function profile($id) 
    {
        $artisan = Artisan::find($id); 
        $products = DB::table('products')
        ->where('artisan_id', $id)
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

}
