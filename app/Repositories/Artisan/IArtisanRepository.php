<?php

namespace App\Repositories\Artisan;

interface IArtisanRepository 
{
    public function getArtisan($user_id);
    public function getArtisanId($user_id);
    public function getArtisanById($artisan_id);
    public function getAll();
    public function createNewArtisan($request);
    public function artisanUpdate($request, $artisan);
    public function getUserIdFromArtisan($id);
    public function setUserArtisanToFalse($user_id);
    public function deleteArtisan($id);
}