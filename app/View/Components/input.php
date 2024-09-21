<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    public  $type, $name, $value, $id, $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $name, $value,$id, $placeholder)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->id=$id;
        $this->placeholder=$placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
