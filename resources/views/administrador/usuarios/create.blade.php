@extends('layouts.administrativo')

@section('titulo')
    Crear usuario
@endsection

@section('encabezado')
    Crear usuario
@endsection

@section('contenido')
<div id="detalleVenta" class="container mx-auto p-6">
    <form action="">
        <p class="font-poppins text-1g">Nombre Usuario</p>
        <input id="txtNombreUsuario" type="text" class="rounded-md mb-10">

        <p class="font-poppins text-1g">Email</p>
        <input id="txtEmail" type="email" class="rounded-md mb-10">

        <p class="font-poppins text-1g">Rol de Usuario</p>

        <select name="cmbRolUsuario" class="font-poppins text-1g rounded-md">
            <option value="cliente">Cliente</option>
            <option value="jefe_ventas" selected>Jefe de Ventas</option>
            <option value="gerente">Gerente</option>
        </select>
    
        <br>
        <button class="mt-7 bg-gray-800 text-white py-2 px-4 rounded-md text-base">
            Confirmar
        </button>
    </form>
    
    
</div>
@endsection