<?php

namespace App\Http\ViewsComposer;


use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class ProductAllergensComposer{

    public function compose(View $view){
        
        $allergensTypes = DB::table('allergens')->get();
        
        $view->with('allergensTypes', $allergensTypes);
        
        
    }

}