<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavItem extends Component
{
    public $href;
    public $icon;
    public $label;
    public $active;

    /**
     * Create a new component instance.
     */
    public function __construct($href, $label, $icon = '', $active = false)
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->label = $label;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-item');
    }
}
