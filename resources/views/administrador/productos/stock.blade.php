@extends('layouts.administrativo')

@section('titulo')
Ingresar stock
@endsection

@section('scripts')
<script src="{{ asset('js/agregarStock.js')}}"></script>
@endsection

@section('encabezado')
Ingresar stock
@endsection

@section('contenido')
<div>
    <div class='flex float-left my-4 mr-5 shadow rounded-lg overflow-hidden ml-1'>
    <table class="leading-normal items-center justify-center border-collapse">
        <thead>
            <tr>
            <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-center text-white">
                C&oacute;digo
            </th>
            <th class="pl-5 pr-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white">
                Nombre
            </th>
            <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-center text-white">
                Stock
            </th>
            <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-center text-white">
                Stock<br>Ingresado
            </th>
            <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-center text-white">
                Precio&nbsp;<br>Unitario
            </th>
            <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-center text-white">
                Precio<br>Nuevo
            </th>
            <th class="pl-2.5 pr-5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white"></th>
            </tr>
            </thead>
        @foreach($productos as $p)
            <tr class='filas' id='{{$p->nombre_producto}}'>
            <td class="px-2.5 py-2 bg-slate-50 font-bold text-center text-slate-700">
                <p>{{$p->id}}</p>
            </td>
            <td class="pl-5 pr-2.5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                {{$p->nombre_producto}}
            </td>
            <td class="px-2.5 py-2 bg-slate-50 font-bold text-center text-slate-700">
                <p>{{$p->stock}}</p>
            </td>
            <td class="px-2.5 py-2 bg-slate-50 font-bold text-center text-slate-700">
                <input id='st{{$p->id}}' name='st{{$p->id}}' step='1' type='number' min='0' class='inpCant w-16 align-top m-0 p-0 border-1 border-gray-800 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
            </td>
            <td class="px-2.5 py-2 bg-slate-50 font-bold text-right text-slate-700">
                @money($p->precio_producto)
            </td>
            <td class="px-2.5 py-2 bg-slate-50 font-bold text-center text-slate-700">
                <input id='pr{{$p->id}}' name='pr{{$p->id}}' step='0.01' type='number' min='0' class='inpCant w-24 align-top m-0 p-0 border-1 border-gray-800 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
            </td>
            <td class="pl-2.5 pr-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                <button type='button' id='b{{$p->id}}' onclick='agregarProd({{$p->id}},"{{$p->nombre_producto}}")' class="btnAgregar bg-gray-800 hover:bg-gray-600 text-white h-8 w-8 text-xl rounded-md">
                    +
                </button>
            </td>
            </tr>
        @endforeach
    </table>
    </div>

    <div class='flex flex-col max-w-[300px]'>
    <input type='text' id='busqueda' placeholder="Buscar producto" onchange="buscar()" class='ml-1 mt-4 w-[250px] rounded-md mr-1 border-gray-600'>
    <form method="POST" action='{{route("producto_updateStock")}}' enctype="multipart/form-data" class='pl-1'>
        <ul id='lista' class="py-4">
            <li id='itemVacio'><input type="text" readonly class="elementoLista w-[250px] rounded-md mr-1 border-gray-600">
                <button type='button' disabled class='btnLista bg-gray-600 hover:bg-gray-600 text-white h-8 w-8 rounded-md'>X</button>
            </li>
        </ul>
        <button type='submit' class="bg-gray-800 hover:bg-gray-700 text-white h-10 w-[150px] rounded-md">
            Ingresar Stock
        </button>
    </form>
    </div>
</div>
@endsection