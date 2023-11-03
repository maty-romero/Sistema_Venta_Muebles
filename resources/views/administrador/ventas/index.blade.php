@extends('layouts.administrativo')

@section('titulo')
    Ventas
@endsection

@section('encabezado')
    Ventas
@endsection

@section('contenido')
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
                    {{ $venta['nombre_cliente'] }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ $venta['tipo_cliente'] }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ date('d-m-Y', strtotime($venta['fecha_venta'])) }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    @money($venta['total_venta'])</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ $venta['domicilio_venta'] }}</td>
                
            </tr>
        @endforeach
    </x-custom.table>
    </div>
@endsection