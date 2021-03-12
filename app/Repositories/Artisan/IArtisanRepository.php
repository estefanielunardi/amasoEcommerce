<?php

namespace App\Repositories\Artisan;
use App\Models\Artisan;
use Illuminate\Http\Request;

interface IArtisanRepository 
{
    public function getArtisan($user_id);
    public function getArtisanId($user_id);
    public function getArtisanById($artisan_id);
    public function getAll();
    public function createNewArtisan(Request $request);
    public function artisanUpdate(Request $request, Artisan $artisan);
    public function getUserIdFromArtisan($id);
    public function setUserArtisanToFalse($user_id);
    public function deleteArtisan($id);
}