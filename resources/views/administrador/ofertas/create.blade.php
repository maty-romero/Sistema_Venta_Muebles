@extends('layouts.administrativo')

@section('titulo')
    Crear oferta
@endsection

@section('scripts')
    <script src="{{ asset('js/formularioCrearOferta.js')}}"></script>
@endsection

@section('encabezado')
    Crear oferta
@endsection

@section('contenido')
    <div class='flex float-left border-white border-r-2 pr-5 pt-4 mr-5'>
    <form action="" class='pl-1 w-full'>
    <table class='w-[100px]'>
    <tr class='block'><td>
        <p class="font-poppins text-1g">Tipo de oferta</p>
        <select id="tipoOferta" name='tipoOferta' onchange='formularioPorTipo()' class="w-[200px] rounded-md mb-5 mr-6 w-36">
            <option></option>
            <option value='unitaria'>Unitaria</option>
            <option value='tipo'>Por tipo</option>
            <option value='combo'>Combo</option>
            <option value='monto'>Por monto</option>
        </select>
    </td>
    <td>
        <p class="font-poppins text-1g">Porcentaje de descuento</p>
        <div class="flex">
            <div class="relative w-[200px] mb-5 mr-1 ">
                <input type='number' id='descuento' max='90' min='5' class="block p-2.5 w-full z-20 text-sm rounded-md border focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" required>
                <div class="absolute mt-[2px] top-0 end-0 p-2.5 text-sm font-medium h-full rounded-e-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle></svg> 
                </div>
            </div>
        </div>
    </td></tr>
    <tr class='block'><td>
        <p class="font-poppins text-1g">Fecha de inicio</p>
        <input id="fechaInicio" type="date" class="w-[200px] rounded-md mb-5 mr-6">
    </td>
    <td>
        <p class="font-poppins text-1g">Fecha de fin</p>
        <input id="fechaFin" type="date" class="w-[200px] rounded-md mb-5">
    </td></tr>
    <tr id='nombreCombo' class='hidden'><td class='w-min'>
        <p class="font-poppins text-1g">Nombre del combo</p>
        <input id="" type="text" placeholder='Ingrese un nombre' class="w-[200px] rounded-md mb-5 placeholder-gray-500">
    </td></tr>
    <tr id='tipoProducto' class='hidden'><td>
        <p class="font-poppins text-1g">Tipo de producto</p>
        <select id="" type="text" class="w-[200px] rounded-md mb-5 w-36">
            <option></option>
            <option value='Interior'>Interior</option>
            <option value='Exterior'>Exterior</option>
        </select>
    </td></tr>
    <tr id='montoMinimo' class='hidden'><td>
        <p class="font-poppins text-1g">Monto m&iacute;nimo</p>
        <div class="relative w-[200px] mb-5 mr-1 ">
            <div class="absolute mt-[2px] top-0 start-0 p-2.5 text-sm font-medium h-full rounded-s-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <input type='number' id="idMontoMin" name="montoMin" min='1' class="pl-6 w-[186px] resize-none rounded-md mb-5 mr-1 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
        </div>
    </td></tr>
    <tr id='seleccionProds' class='hidden'><td>
        <p class="font-poppins text-1g">Selecci&oacute;n de productos</p>
        <input type='text' id="" name="" placeholder='Buscar producto' class="w-[200px] resize-none rounded-md mb-5 mr-1 placeholder-gray-400">
    </td></tr>
    <tr id='encTabla' class='hidden'><td>
        Tabla de productos
    </td></tr>

    <tr id='tablaProds' class='hidden'><td colspan='2'> 
        <div class="container mx-auto">
            <div class="py-1">
                <div class="inline-block shadow rounded-lg overflow-hidden">
                    <table class="leading-normal items-center justify-center border-collapse">
                        <thead>
                            <tr>                           
                                <th class="pl-5 pr-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white">
                                    Nombre
                                </th>  
                                <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white">
                                    Precio&nbsp;Unitario
                                </th> 
                                <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-center text-white">
                                    C&oacute;digo
                                </th> 
                                <th class="px-2.5 py-2 border-b-2 border-gray-500 bg-slate-500 text-center text-white">
                                    Cantidad
                                </th>
                                <th class="pl-2.5 pr-5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white"></th>                    
                            </tr>
                        </thead>
                    @foreach($productos as $p)
                        <tr>
                            <td class="pl-5 pr-2.5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                                {{$p->nombre_producto}}
                            </td>
                            <td class="px-2.5 py-2 bg-slate-50 font-bold text-center text-slate-700">
                                @money($p->precio_producto)
                            </td>
                            <td class="px-2.5 py-2 bg-slate-50 font-bold text-center text-slate-700">
                                <p>{{$p->id}}</p>
                            </td>
                            <td class="px-2.5 py-2 bg-slate-50 font-bold text-center text-slate-700">
                                <div class='w-24 h-content align-baseline mx-auto'>
                                <button type='button' onclick='decrementar({{$p->id}})' class='rounded-l-full bg-gray-800 hover:bg-gray-600 h-8 w-6 m-0 bold text-2xl text-white'>-</button>
                                <input id='{{$p->id}}' type='number' min='1' max='999' value='0' class='inpCant w-8 h-8 align-top m-0 p-0 border-1 border-gray-800 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
                                <button type='button' onclick='incrementar({{$p->id}})' class='rounded-r-full bg-gray-800 hover:bg-gray-600 h-8 w-6 bold text-2xl text-white'>+</button>
                                </div>
                            </td>
                            <td class="pl-2.5 pr-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                                <button type='button' id='b{{$p->id}}' onclick='agregarProd({{$p->id}},"{{$p->nombre_producto}}")' class="btnAgregar bg-gray-800 hover:bg-gray-600 text-white h-8 w-[100px] rounded-md">
                                    Agregar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </td></tr>
    </table>
    </div>

    <div class='flex flex-col w-max-content max-w-[380px] min-w-[250px]'>
        <ul id='lista' class="w-full px-5 mt-4 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
            <li class="elementoLista w-full py-3 h-10 px-4 border-b-[1.5px] border-gray-200 rounded-t-lg dark:border-gray-600"></li>
            <li class="elementoLista w-full py-3 px-4 h-10 border-b-[1.5px] border-gray-200 dark:border-gray-600"></li>
            <li class="elementoLista w-full py-3 px-4 h-10"></li>
        </ul>
        <button type='submit' class="mt-5 ml-auto bg-gray-800 hover:bg-gray-700 text-white h-12 w-[200px] rounded-md">
            Crear oferta
        </button>
    </form>
    </div>
@endsection