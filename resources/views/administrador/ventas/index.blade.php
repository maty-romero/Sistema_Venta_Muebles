@extends('layouts.administrativo')

@section('titulo')
    Ventas
@endsection

@section('encabezado')
    Ventas
@endsection

@section('contenido')
    @php
    $ventas = [
        [
            'cliente' => 'Juan Perez',
            'tipo_cliente' => 'Fisica',
            'fecha' => '21/04/23',
            'total' => 4000,
            'domicilio' => 'Calle Ejemplo 123'
        ],
    ];

    @endphp

    <h3 class='text-3xl text-left ml-4'>Ordenar</h3>
    <div class="flex justify-between ml-4">
    <x-custom.filters>
        <select class="form-control mr-5 rounded-lg" id="ordenamiento">
            <option value="total">Total</option>
            <option value="fecha">Fecha</option>
            <option value="nombreCliente">Nombre del Cliente</option>
        </select>
        <select class="form-control mr-5 rounded-lg" id="direccion_orden">
            <option value="ascendente">Ascendente</option>
            <option value="descendente">Descendente</option>
        </select>
        <x-custom.input-search />
    </x-custom.filters>
    </div>

    <div class="w-full">
    <x-custom.table :columnas="['Cliente', 'Personaria', 'Fecha', 'Total', 'Domicilio de Destino']">
        @foreach ($ventas as $venta)
            <tr>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ $venta['cliente'] }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ $venta['tipo_cliente'] }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    ${{ $venta['fecha'] }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    @money($venta['total'])</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ $venta['domicilio'] }}</td>
                
            </tr>
        @endforeach
    </x-custom.table>
    </div>
@endsection