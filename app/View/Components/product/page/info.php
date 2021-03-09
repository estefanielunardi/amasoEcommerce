<?php

namespace App\View\Components\product\page;

use Illuminate\View\Component;
use App\Models\Product;

class info extends Component
{
    public Product $product;

    public function __construct(Product $product)
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
        return view('components.product.page.info');
    }
}
