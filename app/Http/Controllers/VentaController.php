<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
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
        $carrito = Venta::getCarrito();
        $subtotal = Venta::calcularSubtotal();
        return view('cliente/ventas/carrito', ['carrito' => $carrito, 'subtotal' => $subtotal]);
    }

    public function updateCart($idProd)
    {
        Venta::agregarAlCarrito($idProd);
        return to_route('home');
    }

    public function editCart(FormRequest $r, Producto $prod)
    {
        Venta::editarCantidadCarrito($prod->id, $r->incremento);
        return to_route('carrito');
    }

    public function removeFromCart($idProd)
    {
        Venta::removerDelCarrito($idProd);
        return to_route('carrito');
    }
}
