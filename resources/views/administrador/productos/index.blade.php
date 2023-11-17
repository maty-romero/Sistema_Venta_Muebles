@extends('layouts.administrativo')

@section('titulo')
Productos
@endsection

@section('encabezado')
Productos
@endsection

@section('contenido')

<h3 class='text-3xl text-left ml-1'>Ordenar</h3>
<div class="flex justify-between ml-1">
    <form id="searchForm" name="searchForm" method="GET" action="/searchProducto">
        <select class="form-control mr-5 rounded-lg" id="ordenamiento" name="ordenamiento">
            <option value="precio_producto" {{ isset($input['ordenamiento']) && $input['ordenamiento']==="precio_producto"
                ?"selected":""}}>
                Precio</option>
            <option value="nombre_producto" {{ isset($input['ordenamiento']) && $input['ordenamiento']==="nombre_producto"
                ?"selected":""}}>Nombre</option>
        </select>
        <select class="form-control mr-5 rounded-lg" id="direccion_orden" name="direccion_orden">
            <option value="asc" {{ isset($input['direccion_orden']) && $input['direccion_orden']==="asc"
                ?"selected":""}}>Ascendente</option>
            <option value="desc" {{ isset($input['direccion_orden']) && $input['direccion_orden']==="desc"
                ?"selected":""}}>Descendente</option>
        </select>
        <input id="name" name="name" value="{{isset($input['name'])?$input['name']:''}}" class="py-1 pl-2 rounded-lg border-gray-200" placeholder="Buscar nombre">
    </form>

    <a href="{{ route('administrador_create_producto') }}" class='bg-gray-800 hover:bg-gray-600 text-white py-2 px-4 rounded-md text-base mr-1'>
            Crear Producto
    </a>

</div>

<div class="w-full">
    <x-custom.table :columnas="['Nombre', 'Tipo', 'Discontinuado', 'Precio', 'Stock', 'Modificacion']">
        @foreach ($products as $producto)
        <tr>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900 hover:underline">
                <a href='{{route('administrador_producto_show', $producto->id)}}'>
                {{ $producto->nombre_producto }}
                </a>
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                {{ Str::ucfirst($producto->tipo_mueble->nombre_tipo_mueble) }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                @if ($producto->discontinuado)
                Si
                @else
                No
                @endif
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                @money($producto->precio_producto)</td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                {{ $producto->stock }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left hover:underline text-lg font-semibold text-gray-900">
                <a href="{{ route('administrador_edit_producto', $producto) }}">Editar</a>
                
                <form action="{{ route('administrador_delete_producto', $producto) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </x-custom.table>
</div>
<div class="flex justify-center">{{ $products->links() }}</div>
<script src="{{asset('js/selectProductHandler.js')}}"></script>
@endsection