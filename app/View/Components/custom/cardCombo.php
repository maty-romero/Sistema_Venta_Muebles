<?php

namespace App\View\Components\custom;

use App\Models\OfertaCombo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardCombo extends Component
{
    public $combo;
    /**
     * Create a new component instance.
     */
    public function __construct(OfertaCombo $combo)
    {
        $this->combo = $combo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom.card-combo');
    }
}
