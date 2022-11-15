<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $attr;
    public $tipe;
    public function __construct($attr, $tipe)
    {
        $this->tipe = $tipe;
        $this->attr = $attr;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
