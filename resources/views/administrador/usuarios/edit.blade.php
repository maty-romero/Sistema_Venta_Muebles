@extends('layouts.administrativo')

@section('titulo')
Editar usuario
@endsection

@section('scripts')
<script src="{{ asset('js/formularioCrearUsuario.js')}}"></script>
@endsection

@section('encabezado')
Editar usuario
@endsection

@section('contenido')

@php
    //dump($usuario);
    //dump($cliente);
@endphp

<script>
    window.onload = function() {
    formularioPorTipo(); 
}
</script>
@if(session('success'))
    <div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif


<div id="contenedor" class="container ">
    <form action="{{ route('administrador_update_usuarios', $usuario->id) }}" method="POST">
        @method('PATCH')
        @csrf
        <input type="hidden" name="userID" value="{{ $usuario->id }}">

        <p class="font-poppins text-1g">Nombre de usuario</p>
        <input id="txtNombreUsuario" name="nombreUsuario" type="text" value="{{ $usuario->name }}" class="rounded-md mb-2">
        @error('nombreUsuario')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Email</p>
        <input id="txtEmail" name="email" type="email" value="{{ $usuario->email }}" class="rounded-md mb-2">
        @error('email')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Contraseña</p>
        <input id="txtContrasenia1" name="password" type="password" class="rounded-md mb-2">
        @error('password')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Confirmar contraseña</p>
        <input id="txtContrasenia2" name="password_confirmation" type="password" class="rounded-md mb-2">
        @error('password_confirmation')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Rol de Usuario</p>
        <select id="idCmbRolUsuario" name="cmbRolUsuario" class="font-poppins text-1g rounded-md mb-2" onchange="formularioPorTipo()">
            <option value="cliente" {{ $usuario->rol_usuario == 'cliente' ? 'selected' : '' }}>Cliente</option>
            <option value="jefe_ventas" {{ $usuario->rol_usuario == 'jefe_ventas' ? 'selected' : '' }}>Jefe de Ventas</option>
            <option value="gerente" {{ $usuario->rol_usuario == 'gerente' ? 'selected' : '' }}>Gerente</option>
        </select>
        @error('cmbRolUsuario')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        @if (isset($cliente))
            
        <div id="camposCliente">
            <p id="idPNombreCliente" class="font-poppins text-1g">Nombre cliente</p>
            <input id="txtNombreCliente" name="nombreCliente" value="{{ $cliente->nombre_cliente }}" type="text" class="rounded-md mb-2">
            @error('nombreCliente')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror

            <p id="idPTipoCliente" class="font-poppins text-1g">Tipo de cliente</p>
            <select id="idCmbTipoCliente" name="cmbTipoCliente" class="font-poppins text-1g rounded-md mb-2">
                <option value="fisico" {{ $cliente->tipo_cliente == 'fisico' ? 'selected' : '' }}>Fisico</option>
                <option value="juridico" {{ $cliente->tipo_cliente == 'juridico' ? 'selected' : '' }}>Juridico</option>
            </select>
            @error('cmbTipoCliente')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror

            <p id="idPDniCuit" class="font-poppins text-1g">DNI / CUIT</p>
            <input id="txtDniCuit" name="dni_cuit" value="{{ $cliente->dni_cuit }}" type="number" class="rounded-md mb-2">
            @error('dni_cuit')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror

            <p id="idPCodigoPostal" class="font-poppins text-1g">Codigo postal</p>
            <input id="txtCodigoPostal" name="codigoPostal" value="{{ $cliente->codigo_postal_cliente }}" type="number" class="rounded-md mb-2">
            @error('codigoPostal')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror

            <p id="idPTelefono" class="font-poppins text-1g">N&uacute;mero de T&eacute;lefono</p>
            <input id="txtTelefono" name="telefono" value="{{ $cliente->nro_telefono }}" type="number" class="rounded-md mb-2">
            @error('telefono')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror
        </div>

        @endif

        
        <button type="submit" class="mt-7 bg-gray-800 text-white py-2 px-4 rounded-md text-base">
            Confirmar Cambios
        </button>
    </form>
</div>

@endsection