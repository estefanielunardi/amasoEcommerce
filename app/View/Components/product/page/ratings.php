<?php

namespace App\View\Components\product\page;

use Illuminate\View\Component;

class ratings extends Component
{
    public $rating;

    public function __construct($rating)
    {
       $this->rating = $rating;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.product.page.ratings');
    }
}
