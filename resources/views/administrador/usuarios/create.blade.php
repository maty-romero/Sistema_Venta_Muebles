@extends('layouts.administrativo')

@section('titulo')
Crear usuario
@endsection

@section('scripts')
<script src="{{ asset('js/formularioCrearUsuario.js')}}"></script>
@endsection

@section('encabezado')
Crear usuario
@endsection

@section('contenido')

@php
    //dump(session()->all());
    //dump($errors);     
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
    <form action="{{ route('administrador_store_usuario') }}" method="POST">
        @csrf
        <p class="font-poppins text-1g">Nombre de usuario</p>
        <input id="txtNombreUsuario" name="nombreUsuario" type="text" value="{{ old('nombreUsuario') }}" class="rounded-md mb-5">
        @error('nombreUsuario')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Email</p>
        <input id="txtEmail" name="email" type="email" value="{{ old('email') }}" class="rounded-md mb-5">
        @error('email')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Contraseña</p>
        <input id="txtContrasenia1" name="password" type="password" class="rounded-md mb-5">
        @error('password')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Confirmar contraseña</p>
        <input id="txtContrasenia2" name="password_confirmation" type="password" class="rounded-md mb-5">
        @error('password_confirmation')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror

        <p class="font-poppins text-1g">Rol de Usuario</p>
        <select id="idCmbRolUsuario" name="cmbRolUsuario" class="font-poppins text-1g rounded-md mb-5" onchange="formularioPorTipo()">
            <option value="cliente" {{ old('cmbRolUsuario') == 'cliente' ? 'selected' : '' }}>Cliente</option>
            <option value="jefe_ventas" {{ old('cmbRolUsuario') == 'jefe_ventas' ? 'selected' : '' }}>Jefe de Ventas</option>
            <option value="gerente" {{ old('cmbRolUsuario') == 'gerente' ? 'selected' : '' }}>Gerente</option>
        </select>
        
        
        
        
        @error('cmbRolUsuario')
        <br>
        <small style="color: red">{{ $message }}</small>
        @enderror


        <div id="camposCliente">
            <p id="idPNombreCliente" class="font-poppins text-1g">Nombre cliente</p>
            <input id="txtNombreCliente" name="nombreCliente" value="{{ old('nombreCliente') }}" type="text" class="rounded-md mb-5">
            @error('nombreCliente')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror


            <p id="idPTipoCliente" class="font-poppins text-1g">Tipo de cliente</p>
            <select id="idCmbTipoCliente" name="cmbTipoCliente" class="font-poppins text-1g rounded-md mb-5">
                <option value="fisico">Fisico</option>
                <option value="juridico" selected>Juridico</option>
            </select>
            @error('cmbTipoCliente')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror

            <p id="idPDniCuit" class="font-poppins text-1g">DNI / CUIT</p>
            <input id="txtDniCuit" name="dni_cuit" value="{{ old('dni_cuit') }}" type="number" class="rounded-md mb-5 ">
            @error('dni_cuit')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror

            <p id="idPCodigoPostal" class="font-poppins text-1g">Codigo postal</p>
            <input id="txtCodigoPostal" name="codigoPostal" value="{{ old('codigoPostal') }}" type="number" class="rounded-md mb-5">
            @error('codigoPostal')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror

            <p id="idPTelefono" class="font-poppins text-1g">N&uacute;mero de T&eacute;lefono</p>
            <input id="txtTelefono" name="telefono" value="{{ old('telefono') }}" type="number" class="rounded-md mb-5">
            @error('telefono')
            <br>
            <small style="color: red">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="mt-7 bg-gray-800 text-white py-2 px-4 rounded-md text-base">
            Registrar Usuario
        </button>
    </form>


</div>
@endsection