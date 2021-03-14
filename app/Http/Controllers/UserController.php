<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repositories\Cart\ICartRepository;
use App\Repositories\Product\IProductRepository;
use App\Repositories\User\IUserRepository;

class UserController extends Controller
{
    private IUserRepository $userRepo;
    private ICartRepository $cartRepo;
    private IProductRepository $productRepo;

    public function __construct(ICartRepository $cartRepo, IUserRepository $userRepo, IProductRepository $productRepo)
    {
        $this->cartRepo =  $cartRepo;
        $this->userRepo = $userRepo;
        $this->productRepo = $productRepo;
    }
    public function profile() 
    {
        $id = auth()->id();
        $user = $this->userRepo->getUserById($id);
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
