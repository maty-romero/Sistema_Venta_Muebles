<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Models\Producto;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente')->get();

        // Aquí puedes iterar sobre todas las ventas y crear un array de datos
        $infoVentas = [];

        foreach ($ventas as $venta) {
            $infoVentas[] = [
                'id' => $venta->id,
                'fecha_venta' => $venta->fecha_venta,
                'total_venta' => $venta->monto_final_venta,
                'domicilio_venta' => $venta->domicilio_destino,
                'nombre_cliente' => $venta->cliente->nombre_cliente,
                'tipo_cliente' => $venta->cliente->tipo_cliente,
                
            ];
        }
        
        return view("administrador.ventas.index", ['ventas' => $infoVentas]);
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
