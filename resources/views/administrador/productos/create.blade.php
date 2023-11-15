@extends('layouts.administrativo')

@section('titulo')
Crear Producto
@endsection

@section('encabezado')
Crear producto
@endsection

@php
dump(session('status'));
dump($errors);

@endphp

@section('contenido')
<form action="{{route('administrador_store_producto')}}" method="POST">
    @csrf
    <p class="font-poppins text-1g">Nombre del producto</p>
    <input id="txtNombreProducto" type="text" class="rounded-md mb-5" name="nombre_producto">
    @error('nombre_producto')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror


    <p class="font-poppins text-1g">Descripción</p>
    <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md w-64 mb-5"></textarea>
    @error('descripcion')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror


    <p class="font-poppins text-1g">Stock inicial</p>
    <input id="txtStockInicial" type="number" class="rounded-md mb-5" name="stock">
    @error('stock')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror

    <p class="font-poppins text-1g">Precio</p>
    <input id="txtPrecio" type="number" class="rounded-md mb-5" name="precio_producto">
    @error('precio_producto')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror


    <p class="font-poppins text-1g">Tipo de Mueble</p>
    <select name="id_tipo_mueble" class="font-poppins text-1g rounded-md mb-5">
        <option value="1">Exterior</option>
        <option value="2" selected>Interior</option>
    </select>
    @error('id_tipo_mueble')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror


    <p class="font-poppins text-1g">Medidas</p>
    <p class="font-poppins text-1g">Alto</p>
    <input id="txtAlto" type="number" class="rounded-md mb-5" name="alto">
    @error('alto')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror

    <p class="font-poppins text-1g">Largo</p>
    <input id="txtLargo" type="number" class="rounded-md mb-5" name="largo">
    @error('largo')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror

    <p class="font-poppins text-1g">Ancho</p>
    <input id="txtAncho" type="number" class="rounded-md mb-5" name="ancho">
    @error('ancho')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror

    <br>
    <p>Material</p>
    <select name="material" class="font-poppins text-1g rounded-md mb-5">
        <option value="madera">Madera</option>
        <option value="acero">Acero</option>
        <option value="aluminio">Aluminio</option>
        <option value="Plastico">Plastico</option>
    </select>
    @error('material')
    <small style="color: red">{{ $message }}</small>
    <br>
    @enderror




    <button type="submit" class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-bash">
        Crear producto
    </button>
</form>

@endsection