<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\OrderIncludes;

class IncludeOrder extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $OrderIncludes= OrderIncludes::with('OrderIncludesData')->where(['estatus' => 1])->first();
        return view('components.include-order',compact('OrderIncludes'));
    }
}
