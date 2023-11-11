<!-- component -->

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
                        <input id='{{$p->id}}' type='number' min='1' max='999' value='0' class='w-8 h-8 align-top m-0 p-0 border-1 border-gray-800 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
                        <button type='button' onclick='incrementar({{$p->id}})' class='rounded-r-full bg-gray-800 hover:bg-gray-600 h-8 w-6 bold text-2xl text-white'>+</button>
                        </div>
                    </td>
                    <td class="pl-2.5 pr-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                        <button type='button' action='agregarOferta({{$p->id}})' class="bg-gray-800 hover:bg-gray-600 text-white h-8 w-[100px] rounded-md">
                            Agregar
                        </button>
                    </td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
</div>
