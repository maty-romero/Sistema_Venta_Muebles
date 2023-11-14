<!-- component -->
@if (isset($producto->oferta[0]) && $producto->oferta[0]->porcentaje_descuento>0)

<div class="mx-auto mb-11 w-auto   h-96 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md min-w-[200px]">
  <div class="p-4 relative h-full">
    <div class="absolute right-8 top-6 bg-[#22C55E] text-white px-2 rounded-xl">Descuento {{$producto->oferta[0]->porcentaje_descuento}}%</div>
    <img class="h-60 w-full object-cover object-center  rounded-xl" src="https://images.unsplash.com/photo-1674296115670-8f0e92b1fddb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Product Image" />
    <div class="flex-col items-center mt-6">
      <p class="mt-1 text-sm font-medium text-gray-400 capitalize">{{$producto->tipo_mueble->nombre_tipo_mueble}}</p>
      <p class="text-base font-medium text-black dark:text-gray-300 capitalize">{{$producto->nombre_producto}}</p>

      <p class=" text-xs font-semibold text-[#5690FF] line-through">${{$producto->precio_producto}}</p>
      <p class=" text-base font-semibold text-[#5690FF] ">${{$producto->precio_producto*((100-$producto->oferta[0]->porcentaje_descuento)/100)}}</p>
    </div>
    <div class="flex flex-col card-layer p-4">
      <p class="mt-10 text-2xl font-medium text-white capitalize">{{$producto->nombre_producto}}</p>
      <p class="mt-2 text-sm font-light text-white ">{{$producto->descripcion}}</p>
      <p class="mt-2 text-sm font-medium text-white">Medidas</p>
      <p class="text-sm font-light text-white">Alto: {{$producto->alto}} cm</p>
      <p class="text-sm font-light text-white">Ancho: {{$producto->ancho}} cm</p>
      <div class="flex mt-auto justify-center">
        <a href="{{route('producto.show',['idProd' => $producto->id])}}">
          <button class="rounded-3xl bg-white text-[#5690FF] font-medium text-base px-10 py-3 ">Ver producto</button></a>
      </div>
    </div>
  </div>

</div>
@else
<div class="mx-auto mb-11 w-auto   h-96 transform overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md min-w-[200px]">
  <div class="p-4 relative h-full">
    <img class="h-60 w-full object-cover object-center  rounded-xl" src="https://images.unsplash.com/photo-1674296115670-8f0e92b1fddb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Product Image" />
    <div class="flex-col items-center mt-6">
      <p class="mt-1 text-sm font-medium text-gray-400 capitalize">{{$producto->tipo_mueble->nombre_tipo_mueble}}</p>
      <p class=" text-base  font-medium text-black dark:text-gray-300 capitalize">{{$producto->nombre_producto}}</p>
      <p class=" text-base font-semibold text-[#5690FF] ">${{$producto->precio_producto}}</p>
    </div>
    <div class="card-layer flex-col items-center p-4">
      <p class="mt-10 text-2xl font-medium text-white capitalize">{{$producto->nombre_producto}}</p>
      <p class="mt-2 text-sm font-light text-white ">{{$producto->descripcion}}</p>
      <p class="mt-2 text-sm font-medium text-white">Medidas</p>
      <p class="text-sm font-light text-white">Alto: {{$producto->alto}} cm</p>
      <p class="text-sm font-light text-white">Ancho: {{$producto->ancho}} cm</p>

      <div class="flex mt-auto justify-center">
        <a href="{{route('producto.show',['idProd' => $producto->id])}}">
          <button class="rounded-3xl bg-white text-[#5690FF] font-medium text-base px-10 py-4 ">Ver producto</button></a>
      </div>
    </div>
  </div>

</div>
@endif