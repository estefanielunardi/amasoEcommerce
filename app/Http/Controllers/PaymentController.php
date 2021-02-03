<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function order()
    {

        $id = auth()->id();
        $user = User::find($id);
        $products = $user->getProductsInBasket($id);
        $total = $user->calculateTotal($products);

        return view('purchaseOrder', compact('products', 'total'));
    }

    public function purchase(Request $request)
    {

        $user_id = auth()->id();
        $user = User::find($user_id);
        $user->buyProductsInBasket($user_id);

        $user->id = $user->id;
        $user->name = $user->name;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->created_at = $user->created_at;
        $user->direction = $request->direction;
        $user->location = $request->location;
        $user->postal = $request->postal;
        $user->number_card = $request->number_card;
        $user->expiring_date = $request->expiring_date;

        $user->save();
        return redirect('/');

    }
}
