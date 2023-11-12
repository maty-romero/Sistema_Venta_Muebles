<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view("administrador.usuarios.index", ['usuarios' => $usuarios]);
        
    }
    public function create()
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
