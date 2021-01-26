<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    public function adminDash(){

        $artisanList = Artisan::all();
        return view('dashboard', ['artisanList' => $artisanList]);
    }
}
