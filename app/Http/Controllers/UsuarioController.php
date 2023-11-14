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

    public function update_psw(Request $request){
        $usuario = Auth::user();
        $nuevaContrasenia = $request->input('nuevaContrasenia');
        $usuario->update(['password' => $nuevaContrasenia]);
        return redirect()->back()->with('success','');
    }

    public function edit(string $id)
    {
        ////return view('administrador.usuarios.index', compact('usuario', 'nuevaContrasenia')); 
    }
    public function update(Request $request)
    {
        $usuario =  Auth::user();
        $usuario->update(['email' => $request->input('email')]);

        $cliente = $usuario->cliente;
        $cliente->update([
            'nombre_cliente' => $request->input('nombre'), 
            'dni_cuit' => $request->input('documento'),
            'codigo_postal_cliente' => $request->input('codigoPostal'),
            'nro_telefono' => $request->input('telefono'),
        ]);

        return redirect()->back()->with('success','');
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
