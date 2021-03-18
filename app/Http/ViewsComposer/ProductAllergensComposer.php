<?php

namespace App\Http\ViewsComposer;


use Illuminate\Contracts\View\View;
use App\Repositories\Allergens\IAllergenRepository;

class ProductAllergensComposer
{    
    private IAllergenRepository $allergenRepo;

    public function __construct(IAllergenRepository $allergenRepo)
    {   
        $this->allergenRepo = $allergenRepo;    
    }

    public function compose(View $view){
        
        $allergensTypes = $this->allergenRepo->getAllAllergens();
        
        $view->with('allergensTypes', $allergensTypes);
            
    }

}