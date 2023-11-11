<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Producto;

class VentaController extends Controller
{
    public function index()
    {
       $ventas = Venta::with('cliente')->paginate(5);
       return view("administrador.ventas.index", compact('ventas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    // METODO PARA MOSTRAR CARRITO
    public function cart()
    {
        for ($i=1; $i < 4; $i++) { 
            $carrito[] = Producto::findOrFail($i);
        }

        return view('cliente/ventas/carrito', ['carrito' => $carrito]);
    }
}
