<?php

namespace App\Repositories\Rating;

use App\Models\Ratting;


class RatingRepository implements IRatingRepository
{

    public function findRattingId(Ratting $ratting)
    {
        return Ratting::whereIn('product_id', [$ratting->product_id])
            ->where('user_id', [$ratting->user_id])
            ->value('id');
    }

    public function rattingUpdate($rattingId, Ratting $ratting)
    {
        return Ratting::whereIn('id', [$rattingId])->update(['ratting'=>$ratting->ratting]);
    }

    public function store(Ratting $ratting)
    {
        $ratting->save();
        return;
    }

    public function findAllRatings($id)
    {
        return Ratting::where('product_id', [$id])->get();
    }
    

}