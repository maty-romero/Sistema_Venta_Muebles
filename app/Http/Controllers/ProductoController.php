<?php

namespace App\Http\Controllers;

use App\Models\ComboVendido;
use App\Models\Venta;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //     $producto = Producto::find(1);

        //     echo $producto->oferta;
        $producto = new Producto();
        //Producto::(1)->oferta()->get();
        $productos = Producto::all();
        //$ofertas = array();
        $producto_oferta = array();
        foreach($productos as $producto){
            //$producto_oferta[] = $producto;
            $producto_oferta[] = $producto;  
            $producto_oferta[] = $producto->oferta_combo_producto;
            //echo $producto->oferta;
        } 
        return $producto_oferta;
        // $combo = ComboVendido::where("id_oferta_combo", 7)->first();
        // echo $combo->venta;
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
