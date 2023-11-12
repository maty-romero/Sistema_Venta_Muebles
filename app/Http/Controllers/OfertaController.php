<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaCombo;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Oferta;
use App\Models\TipoMueble;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $tiposProducto = TipoMueble::all();
        return view('administrador.ofertas.create', ['productos' => $productos, 'tiposProducto' => $tiposProducto]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Oferta::crearOferta();
        return to_route('administrador_ofertas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $combo = OfertaCombo::findOrFail($id);
        $enCarrito = Venta::enCarrito('Combo', $id);
        return view('cliente/combo/show', ['combo' => $combo, 'enCarrito' => $enCarrito]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
