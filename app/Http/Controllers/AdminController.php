<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class AdminController extends Controller
{
    public function adminDash(){

        $artisanList = DB::table('artisans')->get();
        return view('adminDashboard', ['artisanList' => $artisanList]);
    }

    public function seeArtisanProfile(Artisan $artisan){

        
        // $request_id = $request->id;
        // $artisan = DB::table('artisans')->where('id', $id);
        
        $products = DB::table('products')
        ->where('artisan_id', $artisan->id)
        ->paginate(3);
        
        return view('profileArtisan', compact('products', 'artisan'));

    }
        

}
