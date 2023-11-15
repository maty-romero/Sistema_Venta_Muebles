<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroUsuarioRequest;
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
use Symfony\Component\Console\Input\Input;

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

    public function store(RegistroUsuarioRequest $request)
    {
        try {
            $validated = $request->validated(); 
            if($validated){

                if ($validated) {
                    $usuario = User::create([
                        'name' => $request->nombreUsuario,
                        'rol_usuario' => $request->cmbRolUsuario,
                        'email' => $request->email,
                        'password' => $request->password
                    ]);
            
                    if ($usuario) {
                        if ($request->cmbRolUsuario === 'cliente') {
                            Cliente::crearCliente($usuario->id);
                            session()->flash('success', 'Usuario y cliente creados con éxito.');
                        } else {
                            session()->flash('success', 'Usuario creado con éxito.');
                        }
                    } else {
                        session()->flash('error', 'Hubo un problema al crear el usuario.');
                    }
                }
            }
            
                
        } catch (\Exception $e) {

            //return redirect()->back()->with('error', 'Hubo un error inesperado')->withInput();
            session()->flash('error', 'Hubo un error inesperado'. $e->getMessage());
        }
            
        return redirect()->back();
         
    }

    public function show()
    {
        $cliente = Auth::user()->cliente;
        $ventas = $cliente->ventas()
            ->orderByRaw("DATE_FORMAT(fecha_venta, '%m/%e/%Y %H:%i') DESC")
            ->get();
        return view('cliente.usuario.index', compact('cliente', 'ventas'));
    }

    public function update_psw(Request $request)
    {
        $usuario = Auth::user();
        $nuevaContrasenia = $request->input('nuevaContrasenia');
        $usuario->update(['password' => $nuevaContrasenia]);
        return redirect()->back()->with('success', '');
    }

    public function edit(string $idUsr)
    {
        $usuario = User::findOrFail($idUsr);
        return view('administrador.usuarios.edit', compact('usuario'));
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

        return redirect()->back()->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //$usuario->delete();
        return redirect()->route('administrador_usuarios');
    }

    public function searchUser(Request $request)
    {

        $name = $request->input("name");
        $orden = $request->input("ordenamiento") === "nombre" ? "name" : "rol_usuario";
        $direccion = $request->input("direccion_orden");
        $usuarios =  User::where('name', 'like', '%' .   $name  . '%')->orderBy($orden, $direccion)->paginate(5);
        $input = $request->input();
        $usuarios->appends(["name" => $name, "orden" => $orden, "direccion_orden" => $direccion]);

        return view("administrador.usuarios.index", compact('usuarios', "input"));
    }
}
