<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfessionalModal extends Component
{
    public $professional;
    /**
     * Create a new component instance.
     */
    public function __construct($professional = null)
    {
        //
        $this->professional = $professional;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.professional-modal');
    }
}
