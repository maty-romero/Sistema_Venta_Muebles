<?php

namespace App\View\Components\custom;

use App\Models\Producto;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardProducto extends Component
{
    public $producto;
    /**
     * Create a new component instance.
     */
    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom.cardProducto');
    }
}
