@extends('layouts.administrativo')

@section('titulo')
    Productos
@endsection

@section('encabezado')
    Productos
@endsection

@section('contenido')

    <h3 class='text-3xl text-left ml-4'>Ordenar</h3>
    <div class="flex justify-between ml-4">
        <x-custom.filters>
            <select class="form-control mr-5 rounded-lg" id="ordenamiento">
                <option value="precio">Precio</option>
                <option value="nombre" selected>Nombre</option>
            </select>
            <select class="form-control mr-5 rounded-lg" id="direccion_orden">
                <option value="ascendente" selected >Ascendente</option>
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
            @foreach ($products as $producto)
                <tr>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        {{ $producto->nombre_producto }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        {{ $producto->tipo_mueble->nombre_tipo_mueble }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">    
                        @if ($producto->discontinuado)
                            SI
                        @else
                            NO    
                        @endif
                        </td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        @money($producto->precio_producto)</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        {{ $producto->stock }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        <a href="{{ route('producto.edit', $producto) }}">Editar</a>
                        <form action="{{ route('producto.destroy', $producto) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                        </form>
                    </td  class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                </tr>
            @endforeach
        </x-custom.table>
    </div>
    <div class="flex justify-center">{{ $products->links() }}</div>
@endsection
