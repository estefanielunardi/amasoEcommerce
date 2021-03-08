<?php

namespace App\View\Components\product\cart\buttons;

use Illuminate\View\Component;

class addButton extends Component
{
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
        return view('components.product.cart.buttons.add-button');
    }
}
