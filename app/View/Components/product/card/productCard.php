<?php

namespace App\View\Components\product\card;

use Illuminate\View\Component;

class productCard extends Component
{
    public $product; 
    public $artisan; 
    public $highlightProducts; 

    public function __construct($product, $artisan, $highlightProducts)
    {
        $this->product = $product;
        $this->artisan = $artisan;
        $this->highlightProducts = $highlightProducts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.product.card.product-card');
    }
}
