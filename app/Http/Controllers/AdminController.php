<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Repositories\Artisan\ArtisanRepository;
use App\Repositories\Product\ProductRepository;


class AdminController extends Controller
{
    private ArtisanRepository $artisanRepo;
    private ProductRepository $productRepo;

    public function __construct()
    {
        $this->artisanRepo = new ArtisanRepository;
        $this->productRepo = new ProductRepository;
    }
    public function adminDash()
    {
        $artisanList =$this->artisanRepo->getAll();

        return view('admin.adminDashboard', ['artisanList' => $artisanList]);
    }

    public function seeArtisanProfile(Artisan $artisan)
    {
        $products = $this->productRepo->getArtisanProducts($artisan->id);

        return view('profileArtisan', compact('products', 'artisan'));
    }
        

    public function deleteArtisan($id)
    {
        
        $user_id = $this->artisanRepo->getUserIdFromArtisan($id);
        $this->artisanRepo->setUserArtisanToFalse($user_id);
        $this->artisanRepo->deleteArtisan($id);
        
        return redirect(route('adminDash'));
    }    

}

       

