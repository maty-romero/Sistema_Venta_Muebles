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

<div id="detalleVenta" class="container mx-auto p-6">
    <form action="{{ route('administrador_store_usuario') }}" method="POST">
        @csrf
        <p class="font-poppins text-1g">Nombre Usuario</p>
        <input id="txtNombreUsuario" name="nombreUsuario" type="text" class="rounded-md mb-5">

        <p class="font-poppins text-1g">Email</p>
        <input id="txtEmail" name="email" type="email" class="rounded-md mb-5">

        <p class="font-poppins text-1g">Contraseña</p>
        <input id="txtContrasenia" name="password" type="password" class="rounded-md mb-5">

        <p class="font-poppins text-1g">Rol de Usuario</p>
        <select id="idCmbRolUsuario" name="cmbRolUsuario" class="font-poppins text-1g rounded-md mb-5" onchange='formularioPorTipo()'>
            <option value="cliente">Cliente</option>
            <option value="jefe_ventas" selected>Jefe de Ventas</option>
            <option value="gerente">Gerente</option>
        </select>
    
        <div id="camposCliente">
            <p id="idPNombreCliente" class="font-poppins text-1g">Nombre cliente</p>
            <input id="txtNombreCliente" name="nombreCliente" type="text" class="rounded-md mb-5"> 
            
            <p id="idPTipoCliente" class="font-poppins text-1g">Tipo de cliente</p>
            <select id="idCmbTipoCliente" name="cmbTipoCliente" class="font-poppins text-1g rounded-md mb-5">
                <option value="fisico">Fisico</option>
                <option value="juridico" selected>Juridico</option>
            </select>

            <p id="idPDniCuit" class="font-poppins text-1g">DNI / CUIT</p>
            <input id="txtDniCuit" name="dni_cuit" type="number" class="rounded-md mb-5 ">

            <p id="idPCodigoPostal" class="font-poppins text-1g">Codigo postal</p>
            <input id="txtCodigoPostal" name="codigoPostal" type="number" class="rounded-md mb-5">

            <p id="idPTelefono" class="font-poppins text-1g">N&uacute;mero de T&eacute;lefono</p>
            <input id="txtTelefono" name="telefono" type="number" class="rounded-md mb-5">
        </div>
        <button type="submit" class="mt-7 bg-gray-800 text-white py-2 px-4 rounded-md text-base">
            Registrar Usuario
        </button>
    </form>
    

</div>
@endsection