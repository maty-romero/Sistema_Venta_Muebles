<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ComboVendido;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Oferta;
use App\Models\OfertaCombo;
use App\Models\OfertaTipoMueble;
use App\Models\Producto;
use App\Models\ProductoVendido;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::paginate(5);
        return view("administrador.usuarios.index", compact('usuarios'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(Request $request)
    //{
    ////
    //}

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
    public function edit(User $usuario)
    {
        
        return view('administrador.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->update(['name' => $request->input('nombreUsuario'),
        'email' => $request->input('email'),
        'rol_usuario' => $request->input('cmbRolUsuario'), ]);

        return  redirect()->route('usuario.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //$usuario->delete();
        return redirect()->route('usuarios.index');
    }
    
}
