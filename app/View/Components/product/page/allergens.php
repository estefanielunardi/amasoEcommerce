<?php

namespace App\View\Components\product\page;

use Illuminate\View\Component;

class allergens extends Component
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
        return view('components.product.page.allergens');
    }
}
