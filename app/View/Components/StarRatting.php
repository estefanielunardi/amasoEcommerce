<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarRatting extends Component
{
    public $midRate;
    public $votesCount;
    public $product;

    public function __construct($midRate, $votesCount, $product)
    {
       $this->midRate = $midRate;
       $this->votesCount = $votesCount;
       $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.star-ratting');
    }
}
