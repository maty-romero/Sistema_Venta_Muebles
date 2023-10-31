<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;

class VentaController extends Controller
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
        $carrito = Venta::getProductosCarrito();
        return view('cliente/ventas/carrito', ['carrito' => $carrito]);
    }

    public function updateCart($idProd)
    {
        Venta::agregarAlCarrito($idProd);
        //return view('producto/'.$idProd);
        return to_route('home');
    }
}
