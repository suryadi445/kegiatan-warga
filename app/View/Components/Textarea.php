<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $attr;
    public $text;
    public $height;
    public $value;
    public function __construct($attr = null, $text = null, $height = null, $value = null)
    {
        $this->attr = $attr;
        $this->text = $text;
        $this->value = $value;
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
