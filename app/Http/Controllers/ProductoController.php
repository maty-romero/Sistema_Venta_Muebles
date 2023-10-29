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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();

        return (view("cliente.welcome", compact("productos")));

        //     echo $producto->oferta;
        // $producto = new Producto();
        // //Producto::(1)->oferta()->get();
        // $productos = Producto::all();
        // //$ofertas = array();
        // $producto_oferta = array();
        // foreach($productos as $producto){
        //     //$producto_oferta[] = $producto;
        //     $producto_oferta[] = $producto;  
        //     $producto_oferta[] = $producto->oferta_combo_producto;
        //     //echo $producto->oferta;
        // } 
        // return $producto_oferta;
        // $combo = ComboVendido::where("id_oferta_combo", 7)->first();
        // echo $combo->venta;

        // $productoVenta = ProductoVendido::where("id_venta", 2)->where("id_producto", 9)->first();
        // echo $productoVenta->oferta;
        // $oferta = Oferta::find(1);
        // echo $oferta->ofertaProductoVendido;

        // $ofertaMueble = OfertaTipoMueble::find(7);
        // echo $ofertaMueble->tipoMueble;

        // $cliente = Cliente::find(1);
        // echo $cliente->usuario;


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

    public function searchProduct(Request $request)
    {
        $productos = Producto::where("nombre_producto", $request->input('name'))->orWhere('nombre_producto', 'like', '%' .  $request->input('name') . '%')->paginate(2);

        $productos->appends(["name" => $request->input('name')]);

        return (view("cliente.productos.index", compact("productos")));
    }
}
