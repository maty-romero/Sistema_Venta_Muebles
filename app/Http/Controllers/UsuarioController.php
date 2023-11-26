<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerfilClienteRequest;
use App\Http\Requests\RegistroClienteRequest;
use App\Http\Requests\RegistroUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
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
        $usuarios = User::where("rol_usuario", "!=", "administrador")->where("id", "!=", Auth::user()->id)->withTrashed()->paginate(5);
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
            if ($validated) {

                $usuario = User::create([
                    'name' => $request->nombreUsuario,
                    'rol_usuario' => $request->cmbRolUsuario,
                    'email' => $request->email,
                    'password' => $request->password
                ]);

                if ($usuario && ($request->cmbRolUsuario === 'cliente')) {
                    Cliente::crearCliente($usuario->id);
                    session()->flash('success', 'Usuario registrado con éxito.');
                } else if ($usuario && ($request->cmbRolUsuario != 'cliente')) {
                    session()->flash('success', 'Usuario registrado con éxito.');
                } else {
                    session()->flash('error', 'Hubo un problema al crear el usuario.');
                }

                /*
                if ($usuario ) {
                    if ($request->cmbRolUsuario === 'cliente') {
                        Cliente::crearCliente($usuario->id);
                        session()->flash('success', 'Usuario y cliente creados con éxito.');
                    } else {
                        session()->flash('success', 'Usuario creado con éxito.');
                    }
                } else {
                    session()->flash('error', 'Hubo un problema al crear el usuario.');
                }
                */
            }
        } catch (\Exception $e) {

            //return redirect()->back()->with('error', 'Hubo un error inesperado')->withInput();
            session()->flash('error', 'Hubo un error inesperado' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function update_user(UpdateUsuarioRequest $request, $idUsr)
    {
        try {
            $validated = $request->validated();
            if ($validated) {

                $usuario = User::findOrFail($idUsr);
                $usuario->update([
                    'name' => $request->nombreUsuario,
                    'rol_usuario' => $request->cmbRolUsuario,
                    'email' => $request->email,
                    'password' => $request->password
                ]);
                //User::update();

                if ($usuario && ($request->cmbRolUsuario === 'cliente')) {

                    Cliente::actualizarCliente($usuario->id);
                    session()->flash('success', 'Usuario actualizado con éxito.');
                } else if ($usuario && ($request->cmbRolUsuario != 'cliente')) {
                    session()->flash('success', 'Usuario actualizado con éxito.');
                } else {
                    session()->flash('error', 'Hubo un problema al actualizar el usuario.');
                }
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Hubo un error inesperado' . $e->getMessage());
        }

        return redirect()->back();
    }


    public function show()
    {
        $cliente = Auth::user()->cliente;
        $ventas = $cliente->ventas()
            ->orderByRaw("DATE_FORMAT(fecha_venta, '%m/%e/%Y %H:%i') DESC")
            ->paginate(5);
        return view('cliente.usuario.index', compact('cliente', 'ventas'));
    }

    public function update_psw(Request $request)
    {
        try {
            $request->validate([
                'nuevaContrasenia' => 'required|min:8',
                'password_confirmation' => 'required|min:8|same:nuevaContrasenia'
            ]);

            $usuario = Auth::user();
            $nuevaContrasenia = $request->input('nuevaContrasenia');
            $usuario->update(['password' => $nuevaContrasenia]);
            return redirect()->back()->with('success_psw', 'Se ha actualizado su contraseña exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_psw', 'No se ha podido actualizar la contraseña: ' . $e->getMessage());
        }
    }

    public function edit($usuario)
    {
        $usuario = User::findOrFail($usuario);
        $cliente = Cliente::where('id_usuario_cliente', $usuario->id)->first();
        return view('administrador.usuarios.edit', compact('usuario', 'cliente'));
    }

    public function update(PerfilClienteRequest $request)
    {
        try {
            $validate = $request->validated();
            if ($validate) {
                $usuario = Auth::user();
                $usuario->update(['email' => $request->input('email')]);

                $cliente = $usuario->cliente;
                $cliente->update([
                    'nombre_cliente' => $request->input('nombre'),
                    'dni_cuit' => $request->input('documento'),
                    'codigo_postal_cliente' => $request->input('codigoPostal'),
                    'nro_telefono' => $request->input('telefono'),
                ]);
                return redirect()->back()->with('success_datos', 'Se ha actualizado tu perfil exitosamente');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error_datos', 'No se ha podido actualizar tu perfil: ' . $e->getMessage());
        }

        /*
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
        */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        $usuario->cliente->delete();
        $usuario->delete();
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
