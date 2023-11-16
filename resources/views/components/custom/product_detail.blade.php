<!-- component -->
<section class="text-gray-700 body-font overflow-hidden bg-white shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
  <div class="container mx-auto flex flex-wrap">
    <div class="container mx-auto flex flex-wrap w-1/2">
      <img alt="{{$producto->nombre_producto}}" class="lg:w-3/4 mx-auto object-cover border-0 object-center rounded border border-gray-200" src="{{ asset($producto->imagenURL) }}">
    </div>
    <div class="lg:w-1/2 w-full lg:px-10 lg:py-6 py-6 px-5 lg:mt-0 bg-[#5690FF]">
      <h1 class="text-gray-900 text-3xl title-font font-medium mb-4 text-white">{{$producto->nombre_producto}}</h1>
      <div class='grid grid-cols-2 w-fit'>
        <p class="title-font font-medium text-2xl text-gray-900 text-white mr-3">@money($producto->getPrecioDeVenta())</p>
        @if($producto->getPrecioDeVenta() != $producto->precio_producto)
        <p class="title-font font-medium text-1xl text-gray-900 text-white mt-auto line-through">@money($producto->precio_producto)</p>
        @endif
      </div>
      <p class="leading-relaxed flex mt-6 items-center text-white pb-2">{{$producto->descripcion}}</p>
      <p class='pb-4 text-white'>Medidas <br> Ancho: {{$producto->ancho}}cm&emsp;Largo: {{$producto->largo}}cm&emsp;Alto: {{$producto->alto}}cm</p>
      <div class="flex-col">      
        @if (!$enCarrito)
          <p class="title-font font-medium text-2xl text-gray-900 text-white border-t-2 border-gray-200 mb-4 pt-4 text-white">Cantidad</p>
          <form method='POST' action='{{route('carrito_agregar', ['tipoItem' => 'Producto', 'id' => $producto->id])}}'>
            @csrf
            <input type='number' name='unidadesProducto' min='1' max='{{$producto->stock}}' value='1' class='flex mr-auto mb-3 h-8 w-56 border-0 text-2xl p-0 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
            <input type='submit' name='agregar' value='Agregar al carrito' class="flex mr-auto hover:cursor-pointer justify-center text-black bg-slate-50 border-0 w-56 py-2 px-6 focus:outline-none hover:bg-zinc-300">
          </form>
        @else
          <p class="title-font font-medium text-2xl text-gray-900 text-white border-t-2 border-gray-200 mb-4 pt-4 text-white">Ya se encuentra en el carrito</p>
        @endif   
      </div>
    </div>
  </div>
</section>