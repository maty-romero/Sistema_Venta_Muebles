@extends('layouts.administrativo')

@section('titulo')
    Crear oferta
@endsection

@section('encabezado')
    Crear oferta
@endsection

@section('contenido')
    <div class='flex float-left border-white border-r-2 pr-5 pt-4 mr-5'>
    <form action="" class='pl-1 w-full'>
    <table class='w-[100px]'>
    <tr>
    <td>
        <p class="font-poppins text-1g">Tipo de oferta</p>
        <select id="" type="text" class="w-[200px] rounded-md mb-5 mr-6 w-36">
            <option></option>
            <option>Unitaria</option>
            <option>Por tipo</option>
            <option>Combo</option>
            <option>Por monto</option>
        </select>
    </td>
    <td>
        <p class="font-poppins text-1g">Porcentaje de descuento</p>
        <input type='number' id="" name="" max='90' min='5' class="w-[200px] resize-none rounded-md mb-5 mr-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"> %
    
    </td>
    </tr>
    <tr>
    <td>
        <p class="font-poppins text-1g">Fecha de inicio</p>
        <input id="" type="date" class="w-[200px] rounded-md mb-5">
    </td>
    <td>
        <p class="font-poppins text-1g">Fecha de fin</p>
        <input id="" type="date" class="w-[200px] rounded-md mb-5">
    </td>
    </tr>
    <tr>
    <td class='w-min'>
        <p class="font-poppins text-1g">Nombre del combo</p>
        <input id="" type="text" class="w-[200px] rounded-md mb-5">
    </td>
    </tr>
    <tr>
    <td>
        <p class="font-poppins text-1g">Tipo de producto</p>
        <select id="" type="text" class="w-[200px] rounded-md mb-5 w-36">
            <option></option>
            <option>Interior</option>
            <option>Exterior</option>
        </select>
    </td>
    </tr>
    <tr>
    <td>
        <p class="font-poppins text-1g">Monto m&iacute;nimo</p>
        $ <input type='number' id="" name="" min='1' class="w-[186px] resize-none rounded-md mb-5 mr-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
    </td>
    </tr>
    <td>
        <p class="font-poppins text-1g">Selecci&oacute;n de productos</p>
        <input type='text' id="" name="" class="w-[200px] resize-none rounded-md mb-5 mr-1">
    </td>
    </tr>
    </tr>
    <td>
        Tabla de productos
    </td>
    </tr>
    
    @php
        $products = [
            [
                'nombre' => 'Producto 1',
                'precio' => 2673.21,
                'codigo' => 23423
            ]
        ];
    @endphp

    <tr><td colspan='2'>
        <x-custom.table_prod_disp></x-custom.table_prod_disp>
    </td></tr>
    </table>
    </form>
    </div>

    <div class='flex flex-col w-max-content max-w-[380px] min-w-[250px]'>
        <ul class="w-full px-5 mt-4 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
            <li class="w-full py-3 h-10 px-4 border-b-[1.5px] border-gray-200 rounded-t-lg dark:border-gray-600">A</li>
            <li class="w-full py-3 px-4 h-10 border-b-[1.5px] border-gray-200 dark:border-gray-600">B</li>
            <li class="w-full py-3 px-4 h-10 border-b-[1.5px] border-gray-200 dark:border-gray-600"></li>
            <li class="w-full py-3 px-4 h-10"></li>
        </ul>
        <button class="mt-5 bg-gray-800 hover:bg-gray-700 text-white h-12 w-[200px] rounded-md">
            Crear oferta
        </button>
    </div>
@endsection