<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Buscador extends Component
{
    public $objecto;
    /**
     * Create a new component instance.
     */
    public function __construct($objecto)
    {
        //
        $this->objecto = $objecto;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buscador');
    }
}
