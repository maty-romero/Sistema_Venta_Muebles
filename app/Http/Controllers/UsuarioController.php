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

    public function update_psw(string $idCliente, Request $request){
        $usuario = User::findOrFail($idCliente);
        $nuevaContrasenia = $request->input('nuevaContrasenia'); 
        $usuario->update(['password' => bcrypt($nuevaContrasenia)]); 
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
