<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function profile() 
    {
        $id = auth()->id();
        $user = User::find($id);
        $userHistoryProducts = [];
        $productIds = DB::table('product_user')
                    ->where('user_id','=', $id)
                    ->orderByDesc('updated_at')
                    ->get('product_id');

        foreach($productIds as $id)
        {
            array_push($userHistoryProducts, Product::find($id->product_id));
        }      
        return view('user.userProfile', compact('userHistoryProducts','user'));
    }
}
