<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class saleItem extends Component
{

    public function __construct(
        public string $imagenURL,
        public string $nombreProducto,
        public string $descripcionProducto,
        public string $fechaVenta,
        public float $totalVenta 
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sale-item');
    }
}
