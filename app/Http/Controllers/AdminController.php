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
        

}
