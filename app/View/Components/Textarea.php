<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $attr;
    public $text;
    public $height;
    public function __construct($attr, $text, $height)
    {
        $this->attr = $attr;
        $this->text = $text;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea');
    }
}
