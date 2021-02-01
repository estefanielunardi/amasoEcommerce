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

        $products = DB::table('products')
        ->where('artisan_id', $artisan->id)
        ->paginate(3);
        return view('profileArtisan', compact('products', 'artisan'));
    }
        

    public function deleteArtisan($id){
        
        $user_id = DB::table('artisans')->where('id', $id)->value('user_id');
        DB::table('users')->where('id', $user_id)->update(['isArtisan'=> 0]);
        DB::table('artisans')->where('id', $id)->delete();
        return redirect(route('adminDash'));
    }    

    public function aproveArtisan($id){

        DB::table('artisans')->where('id', $id)->update(['aproved'=> 1]);
        return redirect(route('adminDash'));
    }
        
        
        
        
        

}

       

