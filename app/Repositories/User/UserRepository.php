<?php

namespace App\Repositories\User;

use App\Repositories\User\IUserRepository;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Artisan;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository {

    public function getUserName($user_id) 
    {
        $user = $this->getUserById($user_id);
        $user = $user->name;
        return $user;
    }

    public function getUserById($user_id) 
    {
        return User::find($user_id);
    }

    public function userUpdate($request, $user) 
    {
        $user->name = $request->name;
        $user->password = Hash::make($request->password);

        $user->save();
    }

}
