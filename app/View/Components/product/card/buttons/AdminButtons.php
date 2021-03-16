<?php

namespace App\View\Components\product\card\buttons;

use Illuminate\View\Component;

class AdminButtons extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $product; 
    
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.product.card.buttons.admin-buttons');
    }
}
