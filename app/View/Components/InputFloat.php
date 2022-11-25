<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputFloat extends Component
{
    public $tipe;
    public $attr;
    public $text;
    public $placeholder;
    public function __construct($tipe, $attr, $text, $placeholder)
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
        return view('components.input-float');
    }
}
