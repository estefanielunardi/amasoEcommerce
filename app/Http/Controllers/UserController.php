<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile() 
    {
        $id = auth()->id();
        $user = User::find($id);
        $userHistoryProducts = [];
        $productIds = DB::table('product_user')
                    ->where('user_id','=', $id)
                    ->where('buyed', true)
                    ->orderByDesc('updated_at')
                    ->get('product_id');

        $ids = [];
  
        $repeatIds = [];
        foreach($productIds as $id)
        {
            array_push($repeatIds, $id->product_id);
        }
        $ids = array_unique($repeatIds);
        
        foreach($ids as $id)
        {
            array_push($userHistoryProducts, Product::find($id));
        }
        return view('user.userProfile', compact('userHistoryProducts','user'));
    }

    public function edit()
    {
        $id = auth()->id();
        $user = User::find($id);
        $name = $user->name;
        
        return view('user.editForm', compact('name'));
    }

    public function update(Request $request)
    {
        $id = auth()->id();
        $user = User::find($id);
        $user->name = $request->name;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect('/user/profile/');
    }
}
