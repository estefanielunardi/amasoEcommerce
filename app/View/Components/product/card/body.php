<?php

namespace App\View\Components\product\card;

use Illuminate\View\Component;

class body extends Component
{
    public $product; 
    public $artisan; 

    public function __construct($product, $artisan)
    {
        $this->product = $product;
        $this->artisan = $artisan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.product.card.body');
    }
}
