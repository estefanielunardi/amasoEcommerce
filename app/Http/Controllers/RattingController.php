<?php

namespace App\Http\Controllers;

use App\Models\Ratting;
use App\Repositories\Rating\IRatingRepository;
use Illuminate\Http\Request;


class RattingController extends Controller
{
    private IRatingRepository $ratingRepo;

    public function __construct(IRatingRepository $ratingRepo)
    {
        $this->ratingRepo = $ratingRepo;
    }
    public function store(Request $request)
    {
        $ratting = new Ratting();
        $ratting->ratting = (int)$request->ratting;
        $ratting->user_id = $request->user()->id;
        $ratting->product_id = $request->id;
        
        $rattingId = $this->ratingRepo->findRattingId($ratting);

        if( $rattingId != null  && $rattingId != 0 ){
            $this->ratingRepo->rattingUpdate( $rattingId, $ratting );
            return back();
        }

        $this->ratingRepo->store($ratting);
        return back();    
    }
}
