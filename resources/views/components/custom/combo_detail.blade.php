<!-- component -->
<section class="text-gray-700 body-font overflow-hidden bg-white shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
  <div class="container mx-auto flex flex-wrap">
    <div class="container mx-auto flex flex-wrap w-1/2">
      <img alt="combo{{$combo->nombre_combo}}" class="lg:w-3/4 mx-auto object-cover border-0 object-center rounded border border-gray-200" src="{{ asset($combo->imagenURL) }}">
    </div>
    <div class="lg:w-1/2 w-full lg:px-10 lg:py-6 py-6 px-5 lg:mt-0 bg-[#5690FF]">
      <h1 class="text-gray-900 text-3xl title-font font-medium mb-4 text-white">{{$combo->nombre_combo}}</h1>
      <div class='grid grid-cols-2 w-fit'>
        <p class="title-font font-medium text-2xl text-gray-900 text-white mr-3">@money($combo->getPrecioCombo())</p>
        <p class="title-font font-medium text-1xl text-gray-900 text-white mt-auto line-through">@money($combo->getPrecioComboSinDescuento())</p>
      </div>

      <div class='pb-4 text-white'>
        <p class="leading-relaxed flex mt-2 items-center text-2xl text-white pb-0">Incluye</p>
        
        @foreach ($combo->oferta_combo_producto as $item)
          <p>- <a class='hover:underline' href='{{route('producto_show', $item->id)}}'>{{$item->nombre_producto}}</a> x{{$item->pivot->cantidad_producto_combo}}</p>
        @endforeach
      
      </div>

      <div class="flex-col">
        @if (!$enCarrito)
        <p class="title-font font-medium text-2xl text-gray-900 text-white border-t-2 border-gray-200 mb-4 pt-4 text-white">Cantidad</p>
          <form method='POST' action='{{route('carrito_agregar', ['tipoItem' => 'Combo', 'id' => $combo->id_oferta_combo])}}'>
            @csrf
            <input type='number' name='unidadesCombo' min='1' max='{{$combo->unidadesMaximas()}}' value='1' class='flex mr-auto mb-3 h-8 w-56 border-0 text-2xl p-0 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
            <input type='submit' name='' value='Agregar al carrito' class="hover:cursor-pointer flex mr-auto justify-center text-black bg-slate-50 border-0 w-56 py-2 px-6 focus:outline-none hover:bg-zinc-300">
          </form>
        @else
        <p class="title-font font-medium text-2xl text-gray-900 text-white border-t-2 border-gray-200 mb-4 pt-4 text-white">
          Ya se encuentra en el carrito</p>
        @endif
      </div>
    </div>
  </div>
</section>