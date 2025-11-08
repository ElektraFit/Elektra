<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MembershipCard extends Component
{
    public $title;
    public $price;
    public $description;
    public $features;
    public $popular;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $price, $description, $features, $popular = false)
    {
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->features = $features;
        $this->popular = $popular;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.membership-card');
    }
}
