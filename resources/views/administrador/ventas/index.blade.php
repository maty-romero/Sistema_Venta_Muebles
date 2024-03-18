@extends('layouts.administrativo')

@section('titulo')
Ventas
@endsection

@section('encabezado')
Ventas
@endsection

@section('contenido')

<h3 class='text-3xl text-left ml-1 mb-1'>Ordenar</h3>
<div class="flex justify-between ml-1">
    <form id="searchForm" name="searchForm" method="GET" action="/searchVenta">
        <select class="form-control mr-5 rounded-lg" id="ordenamiento" name="ordenamiento">
            <option value="monto_final_venta" {{ isset($input['ordenamiento']) && $input['ordenamiento']==="monto_final_venta"
                ?"selected":""}}>Total</option>
            <option value="fecha_venta" {{ isset($input['ordenamiento']) && $input['ordenamiento']==="fecha_venta"
                ?"selected":""}}>Fecha</option>
            <!-- <option value="nombre_cliente" {{ isset($input['ordenamiento']) && $input['ordenamiento']==="nombre"
                ?"selected":""}}>Nombre del Cliente</option> -->
        </select>
        <select class="form-control mr-5 rounded-lg" id="direccion_orden" name="direccion_orden">
            <option value="asc" {{ isset($input['direccion_orden']) && $input['direccion_orden']==="asc"
                ?"selected":""}}>Ascendente</option>
            <option value="desc" {{ isset($input['direccion_orden']) && $input['direccion_orden']==="desc"
                ?"selected":""}}>Descendente</option>
        </select>
        <input id="name" name="name" value="{{isset($input['name'])?$input['name']:''}}" class="py-2 pl-2 rounded-lg mr-5" placeholder="Buscar por cliente">
    </form>
</div>

<div class="w-full text-center">
    <x-custom.table :columnas="['Cliente', 'Personaria', 'Fecha', 'Total', 'Domicilio de Destino', 'Código postal', '']">
        @foreach ($ventas as $venta)
        <tr>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                {{ $venta->cliente->nombre_cliente }}
            </td>
            <td class="px-2 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                {{ Str::ucfirst($venta->cliente->tipo_cliente) }}
            </td>
            <td class="px-2 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                {{ date('d-m-Y', strtotime($venta->fecha_venta)) }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-right text-lg font-semibold text-gray-900">
                @money($venta->monto_final_venta)</td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                {{ $venta->domicilio_destino }}
            </td>
            <td class="px-2 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                {{ $venta->codigo_postal_destino }}
            </td>
            <td class="pl-2 pr-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                <a class="inline-block hover:underline" href="{{ route('cliente_comprobante_compra', ['nroComprobante' => $venta->id]) }}" target="_blank">
                    Detalle
                </a>
            </td>
        </tr>
        @endforeach
    </x-custom.table>

    <div class="flex justify-center">{{ $ventas->links() }}</div>
</div>
<script src="{{asset('js/selectVentaHandler.js')}}"></script>


@endsection