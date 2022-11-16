<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $attr;
    public $tipe;
    public $text;
    public $placeholder;
    public function __construct($attr = null, $tipe = null, $text = null, $placeholder = null)
    {
        $this->tipe = $tipe;
        $this->attr = $attr;
        $this->text = $text;
        $this->placeholder = $placeholder;
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
