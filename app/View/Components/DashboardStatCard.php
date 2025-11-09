<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardStatCard extends Component
{
    public $icon;
    public $value;
    public $label;
    public $instructor;

    /**
     * Create a new component instance.
     */
    public function __construct($value, $label, $icon = null, $instructor = false)
    {
        $this->icon = $icon;
        $this->value = $value;
        $this->label = $label;
        $this->instructor = $instructor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-stat-card');
    }
}
