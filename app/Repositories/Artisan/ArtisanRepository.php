<?php

namespace App\Repositories\Artisan;

use Illuminate\Support\Facades\DB;
use App\Repositories\Artisan\IArtisanRepository;
use App\Models\Artisan;
use Illuminate\Support\Str;

class ArtisanRepository implements IArtisanRepository
{
    public function getArtisan($user_id)
    {
        $artisan_id = $this->getArtisanId($user_id);
        return $this->getArtisanById($artisan_id);
    }

    public function getArtisanId($user_id)
    {
        return DB::table('artisans')->where('user_id', $user_id)->value('id');
    }

    public function getArtisanById($artisan_id)
    {
        return Artisan::find($artisan_id);
    }

    public function getAll()
    {
        $artisans = DB::table('artisans')
            ->where('aproved', '=', 1)
            ->paginate(6);
        return $artisans;
    }

    public function createNewArtisan($request)
    {
        $newArtisan = Artisan::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->id(),
            'slug' => Str::slug($request->name, '-')
        ]);

        $newArtisan->save();
        return $newArtisan;
    }

    public function artisanUpdate($request, $artisan)
    {
        $artisan->name = $request->name;
        $artisan->location = $request->location;
        $artisan->description = $request->description;
        $artisan->image  = $request->image;
        $artisan->user_id = auth()->id();
        $artisan->slug = Str::slug($request->name, '-');

        $artisan->save();
    }

    public function getUserIdFromArtisan($id)
    {
        return DB::table('artisans')->where('id', $id)->value('user_id');
    }

    public function setUserArtisanToFalse($user_id)
    {
        DB::table('users')->where('id', $user_id)->update(['isArtisan' => 0]);
    }

    public function deleteArtisan($id)
    {
        DB::table('artisans')->where('id', $id)->delete();
    }
}
