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
            <option value="precio_producto" {{ isset($input['ordenamiento']) &&
                $input['ordenamiento']==="precio_producto" ?"selected":""}}>
                Precio</option>
            <option value="nombre_producto" {{ isset($input['ordenamiento']) &&
                $input['ordenamiento']==="nombre_producto" ?"selected":""}}>Nombre</option>
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
    <x-custom.table :columnas="['Nombre', 'Tipo', 'Discontinuado', 'Precio', 'Stock', 'Modificacion', '']">
        @foreach ($products as $producto)


        <tr>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900 hover:underline">
                <a href='{{route('administrador_producto_show', $producto->id)}}'>
                    {{ $producto->nombre_producto }}
                </a>
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                {{ Str::ucfirst($producto->tipo_mueble->nombre_tipo_mueble) }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                @if ($producto->discontinuado)
                Si
                @else
                No
                @endif
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                @money($producto->precio_producto)
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                {{ $producto->stock }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left hover:underline text-lg font-semibold text-gray-900">
                <a href="{{ route('administrador_edit_producto', $producto) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                        <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                    </svg>
                </a>
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left  hover:underline text-lg font-semibold text-gray-900">

                <form action="{{route('administrador_delete_producto', $producto)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </x-custom.table>
</div>
<div class="flex justify-center">{{ $products->links() }}</div>
<script src="{{asset('js/selectProductHandler.js')}}"></script>
@endsection