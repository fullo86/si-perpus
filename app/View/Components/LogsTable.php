<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LogsTable extends Component
{
    public $logsData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($logsData)
    {
        $this->logsData = $logsData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.logs-table');
    }
}
