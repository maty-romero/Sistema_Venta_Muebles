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

    public function store(Request  $request)
    {
        /*
        $request->validate([
            'nombreUsuario' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
            'cmbRolUsuario' => ['required'],
        
            // Reglas para cliente
            'nombreCliente' => ['required_if:cmbRolUsuario,cliente'],
            'cmbTipoCliente' => ['required_if:cmbRolUsuario,cliente'],
            'dni_cuit' => ['required_if:cmbRolUsuario,cliente', 'min:8'],
            'codigoPostal' => ['required_if:cmbRolUsuario,cliente'],
            'telefono' => ['required_if:cmbRolUsuario,cliente'],
        ], [
            'nombreUsuario.required' => 'El nombre de usuario es obligatorio',
            'email.required' => 'El campo de correo electrónico es obligatorio',
            'email.unique' => 'El correo electrónico ya está en uso',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos :min caracteres',
            'password_confirmation.same' => 'La confirmación de la contraseña no coincide con la contraseña',
            'cmbRolUsuario.required' => 'El campo de rol de usuario es obligatorio',
        
            // Mensajes para cliente
            'nombreCliente.required_if' => 'El nombre del cliente es obligatorio para el rol de cliente',
            'cmbTipoCliente.required_if' => 'El tipo de cliente es obligatorio para el rol de cliente',
            'dni_cuit.required_if' => 'El DNI o CUIT es obligatorio para el rol de cliente',
            'dni_cuit.min' => 'El DNI o CUIT debe tener al menos :min caracteres',
            'codigoPostal.required_if' => 'El código postal es obligatorio para el rol de cliente',
            'telefono.required_if' => 'El teléfono es obligatorio para el rol de cliente',
        ]);
        

        
        User::create([
            'name' => $request->nombreUsuario,
            'rol_usuario' => $request->cmbRolUsuario,
            'email' => $request->email,
            'password' => $request->password
        ]);
      
        //User::create($request->validated());
        

        //$usuario->save();

        if ($request->cmbRolUsuario === 'cliente') {
            $cliente = new Cliente([
                'nombre_cliente' => $request->nombreCliente,
                'tipo_cliente' => $request->cmbTipoCliente,
                'dni_cuit' => $request->dni_cuit,
                'codigo_postal_cliente' => $request->codigoPostal,
                'nro_telefono' => $request->telefono,
            ]);
    
            $usuario->cliente()->save($cliente);
        }

        session()->flash('status','Usuario creado exitosamente');

        return redirect()->route('usuarios/crear'); 
        */
        return $request; 
    }

    public function show()
    {
        $cliente = Auth::user()->cliente;
        $ventas = $cliente->ventas()->orderBy('fecha_venta', 'asc')->get();
        //$clienteLogeado = User::find($usuario->id)->with('cliente')->first(); 
        return view('cliente.usuario.index', compact('cliente', 'ventas'));
    }

    public function update_psw(Request $request){
        $usuario = Auth::user();
        $nuevaContrasenia = $request->input('nuevaContrasenia');
        $usuario->update(['password' => $nuevaContrasenia]);
        return redirect()->back()->with('success','');
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

        return redirect()->back()->with('success','');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //$usuario->delete();
        return redirect()->route('administrador_usuarios');
    }
    
}
