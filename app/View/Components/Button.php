<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $type;

    public function __construct($type = 'button')
    {
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}

   