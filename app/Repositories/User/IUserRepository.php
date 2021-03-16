<?php

namespace App\Repositories\User;
use Illuminate\Http\Request;
use App\Models\Artisan;
use App\Models\Product;
use App\Models\User;


interface IUserRepository 
{
    public function getUserName($id);
    public function getUserById($id);
}