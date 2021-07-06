<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FiscalYear extends Component
{
    public $container;
    public $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $container)
    {
        $this->url = $url;
        $this->container = $container;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $url = $this->url;
        $container = $this->container;
        return view('components.fiscal-year', compact('url', 'container'));
    }
}
