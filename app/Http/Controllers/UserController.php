<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    private UserRepository $userRepo;
    private CartRepository $cartRepo;
    private ProductRepository $productRepo;

    public function __construct()
    {
        $this->cartRepo = new CartRepository;
        $this->userRepo = new UserRepository;
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
        $user_id = auth()->id();
        $name = $this->userRepo->getUserName($user_id);

        return view('user.editForm', compact('name'));
    }

    public function update(Request $request)
    {
        $user_id = auth()->id();
        $user = $this->userRepo->getUserById($user_id);
        $this->userRepo->userUpdate($request, $user);
        return redirect('/user/profile/');
    }
}
