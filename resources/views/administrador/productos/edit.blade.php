@extends('layouts.administrativo')

@section('titulo')
    Editar Producto
@endsection

@section('encabezado')
    Editar producto
@endsection

@section('contenido')
    <form action="">
        <p class="font-poppins text-1g">Nombre del producto</p>
        <input id="txtNombreProducto" type="text" class="rounded-md w-64 mb-5">

        <p class="font-poppins text-1g">Descripción</p>
        <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md w-64 mb-5"></textarea>

        <p class="font-poppins text-1g">Precio</p>
        <input id="txtPrecio" type="number" class="rounded-md w-64 mb-5">

        <p class="font-poppins text-1g">Tipo de Mueble</p>
        <select name="cmbTipoMueble" class="font-poppins text-1g rounded-md w-64 mb-5">
            <option value="cliente">Interior</option>
            <option value="jefe_ventas" selected>Exterior</option>
        </select>

        <p class="font-poppins text-1g">Stock</p>
        <input id="txtStockInicial" type="number" class="rounded-md w-64 mb-5">

        <x-modal name="pepe">
            <h3>Agregar stock</h3>
            <div class="align-text-bottom items-end ml-auto">
                <button class='rounded-l-full bg-white h-8 w-8 bold text-2xl'>-</button>
                <input type='number' min='1' max='' value='' class='w-14 h-8 border-0 text-2xl p-0 text-center my-auto [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
                <button class='rounded-r-full bg-white h-8 w-8 bold text-2xl'>+</button>
            </div>
            <p>Actualizar precio</p>
            <input type="number" name="txtNuevoPrecio" id="idTxtNuevoPrecio" class="rounded-md mb-5">
            <button x-on:click="$dispatch('close')" class="bg-red-500 text-white px-4 py-2 mt-4">Confirmar</button>
        </x-modal>

        <button x-on:click="$dispatch('open-modal', 'pepe')" type="button" class="mt-5 bg-gray-500 text-white py-2 px-4 rounded-md text-base ml-4">
            Actualizar stock
        </button>

        <br>
        <button class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-base">
            Crear producto
        </button>

    </form>
@endsection