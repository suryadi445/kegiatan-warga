<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modal extends Component
{
    public $title;
    public $action;
    public $method;
    public $modal;
    public function __construct($title = null, $action = null, $method = null, $modal = null)
    {
        $this->method = $method;
        $this->action = $action;
        $this->title = $title;
        $this->modal = $modal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
