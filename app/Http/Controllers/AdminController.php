<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use SebastianBergmann\Environment\Console;

class AdminController extends Controller
{
    public function adminDash(){

        $artisanList = User::where('isArtisan', true)->get();
        return view('adminDashboard', ['artisanList' => $artisanList]);
    }
        

}
