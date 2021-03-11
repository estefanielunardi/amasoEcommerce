<?php

namespace App\View\Components\product\card;

use Illuminate\View\Component;

class header extends Component
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
        return view('components.product.card.header');
    }
}
