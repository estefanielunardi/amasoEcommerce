<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artisan; 

class ArtisanController extends Controller
{
    public function artisanProfile($id) 
    {
        $artisan = Artisan::find($id); 
        return view('profileArtisan', compact('artisan'));
    }

}
