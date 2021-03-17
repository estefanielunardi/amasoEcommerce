<?php

namespace App\Repositories\Allergens;

use Illuminate\Support\Facades\DB;
use App\Repositories\Allergens\IAllergenRepository;

class AllergenRepository implements IAllergenRepository
{
    
    public function getAllAllergens()
    {
        $allergensTypes = DB::table('allergens')->get();

        return $allergensTypes;

    }
}