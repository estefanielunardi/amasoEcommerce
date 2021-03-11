<?php

namespace App\Repositories\Rating;

use App\Models\Ratting;
use Illuminate\Http\Request;


interface IRatingRepository
{
    public function findRattingId( Ratting $ratting );
    public function rattingUpdate( $rattingId, Ratting $ratting );
    public function store( Ratting $ratting );
    public function findAllRatings( $id );
}