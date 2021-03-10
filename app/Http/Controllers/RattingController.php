<?php

namespace App\Http\Controllers;

use App\Models\Ratting;
use Illuminate\Http\Request;

class RattingController extends Controller
{
    
    public function store(Request $request)
    {
        $ratting = new Ratting();
        $ratting->ratting = (int)$request->ratting;
        $ratting->user_id = $request->user()->id;
        $ratting->product_id = $request->id;
        
        $rattingId = Ratting::whereIn('product_id', [$ratting->product_id])
            ->where('user_id', [$ratting->user_id])
            ->value('id');

        if($rattingId != null  && $rattingId != 0 ){
            Ratting::whereIn('id', [$rattingId])->update(['ratting'=>$ratting->ratting]);
            
            return back();
        }

        $ratting->save();
        return back();
        
    }
   
}
