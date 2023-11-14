@extends('layouts.administrativo')

@section('titulo')
    Editar usuario
@endsection

@section('encabezado')
    Crear usuario
@endsection

@section('contenido')
<div id="detalleVenta" class="container mx-auto p-6">
    <form action="{{ route('administrador_update_usuarios', $usuario) }}" method="POST">
        @method('PUT')
        @csrf
        <p class="font-poppins text-1g">Nombre Usuario</p>
        <input id="txtNombreUsuario" type="text" class="rounded-md mb-10" value="{{ $usuario->name }}" name="nombreUsuario">

        <p class="font-poppins text-1g">Email</p>
        <input id="txtEmail" type="email" class="rounded-md mb-10" value="{{ $usuario->email }}" name="email">

        <p class="font-poppins text-1g">Rol de Usuario</p>

        <select name="cmbRolUsuario" class="font-poppins text-1g rounded-md">
            <option value="cliente" selected>Cliente</option>
            <option value="jefe_ventas">Jefe de Ventas</option>
            <option value="gerente">Gerente</option>
        </select>
    
        <br>
        <button type="submit" class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-bash">
            Editar Usuario
        </button>
    </form>
    

</div>
@endsection