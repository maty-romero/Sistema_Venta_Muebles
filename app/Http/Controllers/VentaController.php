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
        //$ventas = Venta::table('ventas')
        //    ->join('contacts', 'ventas.id', '=', 'contacts.user_id')
        //    ->select('users.*', 'contacts.phone')
        //    ->orderBy('fecha_venta', 'asc')
        //    ->paginate(5);
        $ventas = Venta::orderBy('fecha_venta', 'asc')->paginate(5);;
        //$ventas = Venta::paginate(5);
        return (view("administrador.ventas.index", compact("ventas")));
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
