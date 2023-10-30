@extends('layouts.administrativo')

@section('titulo')
    Crear Producto
@endsection

@section('encabezado')
    Crear producto
@endsection

@section('contenido')
    <form action="">
        <p class="font-poppins text-1g">Nombre del producto</p>
        <input id="txtNombreProducto" type="text" class="rounded-md mb-5">

        <p class="font-poppins text-1g">Descripci&oacute;n</p>
        <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md mb-5"></textarea>

        <p class="font-poppins text-1g">Precio</p>
        <input id="txtPrecio" type="number" class="rounded-md mb-5">

        <p class="font-poppins text-1g">Tipo de Mueble</p>
        <select name="cmbTipoMueble" class="font-poppins text-1g rounded-md mb-5">
            <option value="cliente">Interior</option>
            <option value="jefe_ventas" selected>Exterior</option>
        </select>

        <p class="font-poppins text-1g">Stock inicial</p>
        <input id="txtStockInicial" type="number" class="rounded-md mb-5">
        <br>
        <button class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-base">
            Crear producto
        </button>
    </form>
@endsection