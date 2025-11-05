<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Center;
use App\Models\Professional;

class CourseCreateModal extends Component
{
    public $centers;
    public $professionals;

    public function __construct()
    {
        
        $this->centers = Center::all();
        $this->professionals = Professional::all();
    }

    public function render()
    {
        return view('components.course-create-modal');
    }
}
