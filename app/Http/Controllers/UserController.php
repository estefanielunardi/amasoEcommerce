<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Product\ProductRepository;

class UserController extends Controller
{
    private CartRepository $cartRepo;
    private ProductRepository $productRepo;

    public function __construct()
    {
        $this->cartRepo = new CartRepository;
        $this->productRepo = new ProductRepository;
    }
    public function profile() 
    {
        $id = auth()->id();
        $user = User::find($id);
        $userHistoryProducts = [];
        $productIds = $this->cartRepo->getProductsIdsWhereUserId($id);

        $ids = [];
  
        $repeatIds = [];
        foreach($productIds as $id)
        {
            array_push($repeatIds, $id->product_id);
        }
        $ids = array_unique($repeatIds);
        
        foreach($ids as $id)
        {
            array_push($userHistoryProducts, $this->productRepo->findProduct($id));
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
