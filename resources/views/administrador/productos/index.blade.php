@extends('layouts.administrativo')

@section('titulo')
    Productos
@endsection

@section('encabezado')
    Productos
@endsection

@section('contenido')

    @php
        $products = [
            [
                'nombre' => 'Producto 1',
                'cantidad' => 3,
                'precio' => 25000,
                'descuento' => 5000,
            ],
        ];

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
                        {{ $product['nombre'] }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        {{ $product['cantidad'] }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        ${{ number_format($product['precio'], 2) }}</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        ${{ number_format($product['descuento'], 2) }} (20%)</td>
                    <td
                        class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                        ${{ number_format($product['cantidad'] * ($product['precio'] - $product['descuento']), 2) }}</td>
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

@endsection
