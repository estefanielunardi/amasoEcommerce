<?php

namespace App\View\Components\product\page;

use Illuminate\View\Component;

class comments extends Component
{
    public $replies;
    public $comments;
    public $product;

    public function __construct($replies, $comments, $product)
    {
        $this->comments = $comments;
        $this->replies = $replies;
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.product.page.comments');
    }
}
