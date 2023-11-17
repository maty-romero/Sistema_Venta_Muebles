@props(["combo"])

<div class="mx-auto mb-11 w-auto h-96 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md min-w-[200px]">
    <div class="p-4 relative h-full">
        <div class="absolute right-8 top-6 bg-[#4DBAF8] text-white px-2 rounded-xl">Combo -{{$combo["descuentoCombo"]}}%
        </div>
        <img class="h-60 w-full object-cover object-center  rounded-xl" src="{{asset($combo['imagenURL'])}}" alt="Combo Image" />
        <div class="flex-col items-center mt-6">
            <p class="mt-1 text-sm font-medium text-gray-400 capitalize">Combo</p>
            <p class="text-base font-medium text-black dark:text-gray-300 capitalize">{{$combo["nombreCombo"]}}</p>
            <p class=" text-xs font-semibold text-[#5690FF] line-through">@money($combo["precioTotal"])</p>
            <p class=" text-base font-semibold text-[#5690FF] ">
                @money($combo["precioTotal"]*((100-$combo["descuentoCombo"])/100))</p>
        </div>
        <div class="flex flex-col card-layer p-4">

            <p class="mt-10 text-2xl font-medium text-white capitalize">{{$combo["nombreCombo"]}}</p>
            <p class="mt-2 text-sm font-medium text-white">Contenido del combo</p>
            @foreach ($combo["infoContenidoCombo"] as $producto)
            <p class="text-sm font-light text-white">{{ $producto["producto"]->nombre_producto }} x {{
                $producto["cantidadCombo"]}} unidades </p>
            @endforeach

            <div class="flex mt-auto justify-center">
                <a href="{{route('combo_show',['idCombo' => $combo['idCombo']])}}">
                    <button class=" rounded-3xl bg-white text-[#5690FF] font-medium text-base px-10 py-3 ">
                        Ver combo
                    </button></a>
            </div>
        </div>
    </div>

</div>