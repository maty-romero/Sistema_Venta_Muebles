<!-- component -->

<div class="container mx-auto">
    <div class="py-1">
        <div class="inline-block shadow rounded-lg overflow-hidden">
            <table class="leading-normal items-center justify-center border-collapse">
                <thead>
                    <tr>                           
                        <th class="pl-5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white">
                            Nombre
                        </th>  
                        <th class="pl-5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white">
                            Precio&nbsp;Unitario
                        </th> 
                        <th class="pl-5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white">
                            C&oacute;digo
                        </th> 
                        <th class="pl-5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white">
                            Cantidad
                        </th>
                        <th class="px-5 py-2 border-b-2 border-gray-500 bg-slate-500 text-left text-white"></th>                    
                    </tr>
                </thead>
                <tr>
                    <td class="pl-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                        Silla
                    </td>
                    <td class="pl-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                        @money(20000)
                    </td>
                    <td class="pl-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                        <p>#3521</p>
                    </td>
                    <td class="pl-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                        <div class='w-24 h-content align-baseline'>
                        <button class='rounded-l-full bg-gray-800 hover:bg-gray-600 h-8 w-6 m-0 bold text-2xl text-white'>-</button>
                        <input type='number' min='1' max='999' value='' class='w-8 h-8 align-top m-0 p-0 border-1 border-gray-800 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
                        <button class='rounded-r-full bg-gray-800 hover:bg-gray-600 h-8 w-6 bold text-2xl text-white'>+</button>
                        </div>
                    </td>
                    <td class="px-5 py-2 bg-slate-50 font-bold text-left text-slate-700">
                        <button class="bg-gray-800 hover:bg-gray-600 text-white h-8 w-[100px] rounded-md">
                            Agregar
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
