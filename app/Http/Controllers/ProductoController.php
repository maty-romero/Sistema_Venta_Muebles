<?php

namespace App\Http\Controllers;

use App\Models\ComboVendido;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\OfertaTipoMueble;
use App\Models\Producto;
use App\Models\ProductoVendido;
use App\Models\User;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return (view("cliente.welcome", compact("productos")));
    }

    public function index_adm(){
        $productos = Producto::within('tipos_muebles');
        //$productos->tipo_mueble; 
        return (view("administrador.productos.index", compact("productos")));
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
        $producto = Producto::findOrFail($id);
        return view('cliente/productos/show', ['producto' => $producto]);
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

    public function searchProduct(Request $request)
    {
        $productos = Producto::where("nombre_producto", $request->input('name'))->orWhere('nombre_producto', 'like', '%' .  $request->input('name') . '%')->paginate(2);

        $productos->appends(["name" => $request->input('name')]);

        return (view("cliente.productos.index", compact("productos")));
    }
}
