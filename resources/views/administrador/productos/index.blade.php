@extends('layouts.administrativo')

@section('titulo')
    Productos
@endsection

@section('encabezado')
    
@endsection

@section('contenido')
<h1>Prductos</h1>
<h2>Ordenar</h2>
<select name="select1">
  <option value="Nombre" selected>Alfabeticamente</option>
  <option value="Precio">Precio</option>
  <option value="Fecha">Fecha</option>
</select>
<select name="select2">
  <option value="Acendente" selected>Acendente</option>
  <option value="Decendente">Decendente</option>
</select>
<input type="text">
<a href="{{ route('producto.create') }}">Crear producto</a>
<div>
    <table>
        <tr>
            <td>Nombre</td>
            <td>Tipo</td>
            <td>Discontinuado</td>
            <td>Precio</td>
            <td>stock</td>
            <td>Modificacion</td>
        </tr>
        @foreach ( $productos as $producto )
        <tr>
        <td>{{$producto-> nombre_producto}}</td>
        <td>@if($producto-> id_tipo_mueble =='1')
    <p>Exterior</p>
    @else 
    <p>Interior</p>
    @endif
        </td>
        <td>@if($producto-> discontinuado =='1')
    <input type="radio"checked="checked" disabled/>
    @else 
    <input type="radio" disabled/>
    @endif</td>
        <td>{{$producto-> precio_producto}}</td>
        <td>{{$producto-> stock}}</td>
        <td>
        <a href="{{ route('producto.edit', $producto) }}">Editar</a>
            <form action="{{ route('producto.destroy', $producto) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
        </tr>
        @endforeach
    </table>
    {{ $productos->links() }}
</div>


    @php
    //dump($products);
    //$products = $data; 
    @endphp

    <h3 class='text-3xl text-left ml-4'>Ordenar</h3>
    <div class="flex justify-between ml-4">
        <x-custom.filters>
            <select class="form-control mr-5 rounded-lg" id="ordenamiento">
                <option value="precio">Precio</option>
                <option value="nombre">Nombre</option>
            </select>
            <select class="form-control mr-5 rounded-lg" id="direccion_orden">
                <option value="ascendente">Ascendente</option>
                <option value="descendente">Descendente</option>
            </select>
            <x-custom.input-search />
        </x-custom.filters>

        <a href="{{ route('administrador_create_producto') }}">
            <button class="bg-gray-800 text-white py-2 px-4 rounded-md text-base mt-4 mr-4">
                Crear Producto
            </button>
        </a>
    </div>

    <div class="w-full">
        <x-custom.table :columnas="['Nombre', 'Tipo', 'Discontinuado', 'Precio', 'Stock', 'Modificacion', '']">
            @foreach ($products as $product)
                <tr>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        {{ $product->nombre_producto }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        {{ $product->tipo_mueble->nombre_tipo_mueble }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">    
                        @if ($product->discontinuado)
                            SI
                        @else
                            NO    
                        @endif
                        </td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        @money($product->precio_producto)</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        {{ $product->stock }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        <a href="">Modificar</a></td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        <a href="">Eliminar</a></td>
                </tr>
            @endforeach
        </x-custom.table>
    </div>
    <div class="flex justify-center">{{ $products->links() }}</div>
@endsection
