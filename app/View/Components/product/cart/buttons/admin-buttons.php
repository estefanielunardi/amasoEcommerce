<?php

namespace App\View\Components\product\cart\buttons;

use Illuminate\View\Component;

class adminButtons extends Component
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
        return view('components.product.cart.buttons.admin-buttons');
    }
}
