<!-- component -->

@if (isset($producto->ofertaValida) && isset($producto->ofertaValida[0]) &&
$producto->ofertaValida[0]->porcentaje_descuento>0)
<!--TIENE OFERTA Y -->
{{-- @foreach ( $producto->ofertaValida->ofertaMueble as $oferta) --}}

<!--NO TIENE OFERTA COMBO O MUEBLE -->

<div
  class="mx-auto mb-11 w-auto  h-96 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md min-w-[200px]">
  <div class="p-4 relative h-full">
    <div class="absolute right-8 top-6 bg-[#22C55E] text-white px-2 rounded-xl">Descuento
      {{$producto->ofertaValida[0]->porcentaje_descuento}}%</div>
    <img class="h-60 w-full object-cover object-center  rounded-xl" src="{{asset($producto->imagenURL)}}"
      alt="Product Image" />
    <div class="flex-col items-center mt-6">
      <p class="mt-1 text-sm font-medium text-gray-400 capitalize">{{$producto->tipo_mueble->nombre_tipo_mueble}}</p>
      <p class="text-base font-medium text-black dark:text-gray-300 capitalize">{{$producto->nombre_producto}}</p>

      <p class=" text-xs font-semibold text-[#5690FF] line-through">@money($producto->precio_producto)</p>
      <p class=" text-base font-semibold text-[#5690FF] ">
        @money($producto->precio_producto*((100-$producto->ofertaValida[0]->porcentaje_descuento)/100))</p>
    </div>
    <div class="flex flex-col card-layer p-4">
      <p class="mt-10 text-2xl font-medium text-white capitalize">{{$producto->nombre_producto}}</p>
      <p class="mt-2 text-sm font-light text-white ">{{strlen($producto->descripcion)>140?substr($producto->descripcion,
        0, -(strlen($producto->descripcion)-140))."...":$producto->descripcion}}</p>
      <p class="mt-2 text-sm font-medium text-white">Medidas</p>
      <p class="text-sm font-light text-white">Alto: {{$producto->alto}} cm</p>
      <p class="text-sm font-light text-white">Ancho: {{$producto->ancho}} cm</p>
      <div class="flex mt-auto justify-center">
        <a href="{{route('producto_show',['idProd' => $producto->id])}}">
          <button class="rounded-3xl bg-white text-[#5690FF] font-medium text-base px-10 py-3 ">Ver
            producto</button></a>
      </div>
    </div>
  </div>
</div>
@elseif(isset($producto->ofertaTipoValida()[0]) && $producto->ofertaTipoValida()[0]->porcentaje_descuento>0)
<div
  class="mx-auto mb-11 w-auto  h-96 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md min-w-[200px]">
  <div class="p-4 relative h-full">
    <div class="absolute right-8 top-6 bg-[#c45dbe] text-white px-2 rounded-xl">
      {{$producto->ofertaTipoValida()[0]->id_tipo_mueble == 1 ? "Exterior" : "Interior"}}
      -{{$producto->ofertaTipoValida()[0]->porcentaje_descuento}}%
    </div>
    <img class="h-60 w-full object-cover object-center  rounded-xl" src="{{asset($producto->imagenURL)}}"
      alt="Product Image" />
    <div class="flex-col items-center mt-6">
      <p class="mt-1 text-sm font-medium text-gray-400 capitalize">Oferta
        {{$producto->ofertaTipoValida()[0]->id_tipo_mueble == 1 ? "Exterior" : "Interior"}}
      </p>
      <p class="text-base font-medium text-black dark:text-gray-300 capitalize">{{$producto->nombre_producto}}</p>

      <p class=" text-xs font-semibold text-[#5690FF] line-through">@money($producto->precio_producto)</p>
      <p class=" text-base font-semibold text-[#5690FF] ">
        @money($producto->precio_producto*((100-$producto->ofertaTipoValida()[0]->porcentaje_descuento)/100))</p>
    </div>
    <div class="flex flex-col card-layer p-4">
      <p class="mt-10 text-2xl font-medium text-white capitalize">{{$producto->nombre_producto}}</p>
      <p class="mt-2 text-sm font-light text-white ">{{strlen($producto->descripcion)>140?substr($producto->descripcion,
        0, -(strlen($producto->descripcion)-140))."...":$producto->descripcion}}</p>
      <p class="mt-2 text-sm font-medium text-white">Medidas</p>
      <p class="text-sm font-light text-white">Alto: {{$producto->alto}} cm</p>
      <p class="text-sm font-light text-white">Ancho: {{$producto->ancho}} cm</p>
      <div class="flex mt-auto justify-center">
        <a href="{{route('producto_show',['idProd' => $producto->id])}}">
          <button class="rounded-3xl bg-white text-[#5690FF] font-medium text-base px-10 py-3 ">Ver
            producto</button></a>
      </div>
    </div>
  </div>
</div>
{{-- @endforeach --}}
<!--SI NO TIENE OFERTAS -->
@else
<div
  class="mx-auto mb-11 w-auto  h-96 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md min-w-[200px]">
  <div class="p-4 relative h-full">
    <img class="h-60 w-full object-cover object-center  rounded-xl" src="{{asset($producto->imagenURL)}}"
      alt="Product Image" />
    <div class="flex-col items-center mt-6">
      <p class="mt-1 text-sm font-medium text-gray-400 capitalize">{{$producto->tipo_mueble->nombre_tipo_mueble}}</p>
      <p class=" text-base  font-medium text-black dark:text-gray-300 capitalize">{{$producto->nombre_producto}}</p>
      <p class=" text-base font-semibold text-[#5690FF] ">@money($producto->precio_producto)</p>
    </div>
    <div class="flex flex-col card-layer p-4">
      <p class="mt-10 text-2xl font-medium text-white capitalize">{{$producto->nombre_producto}}</p>
      <p class="mt-2 text-sm font-light text-white ">{{strlen($producto->descripcion)>140?substr($producto->descripcion,
        0, -(strlen($producto->descripcion)-140))."...":$producto->descripcion}}</p>
      <p class="mt-2 text-sm font-medium text-white">Medidas</p>
      <p class="text-sm font-light text-white">Alto: {{$producto->alto}} cm</p>
      <p class="text-sm font-light text-white">Ancho: {{$producto->ancho}} cm</p>

      <div class="flex mt-auto justify-center">
        <a href="{{route('producto_show',['idProd' => $producto->id])}}">
          <button class="rounded-3xl bg-white text-[#5690FF] font-medium text-base px-10 py-3 ">Ver
            producto</button></a>
      </div>
    </div>
  </div>

</div>
@endif