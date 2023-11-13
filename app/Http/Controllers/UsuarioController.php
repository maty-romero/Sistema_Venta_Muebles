<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index()
    {
        $usuarios = User::paginate(5);
        return view("administrador.usuarios.index", compact('usuarios'));
    }
    public function create()
    {
        return view('administrador.usuarios.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        $cliente = Auth::user()->cliente;
        $ventas = $cliente->ventas()->orderBy('fecha_venta', 'desc')->get();
        //$clienteLogeado = User::find($usuario->id)->with('cliente')->first(); 
        return view('cliente.usuario.index', compact('cliente', 'ventas'));
    }

    public function edit(string $id)
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
