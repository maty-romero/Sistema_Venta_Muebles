<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use App\Models\ComboVendido;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\OfertaCombo;
use App\Models\OfertaTipoMueble;
use App\Models\Producto;
use App\Models\ProductoVendido;
use App\Models\User;

class OfertaController extends Controller
{
     
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tipoOferta = $request->input('tipoOferta');
            $campoOrden = $request->input('campoOrden');
            $direccionOrden = $request->input('direccionOrden'); 
    
            $ofertas = Oferta::with($tipoOferta)
                ->orderBy($campoOrden, $direccionOrden)
                ->get();
    
            return response()->json(['ofertas' => $ofertas]);
        }
    
        // Sino hay solicitud AJAX  
        return view('administrador.ofertas.index');

    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
    
    public function destroy(string $id)
    {
        //
    }
}
