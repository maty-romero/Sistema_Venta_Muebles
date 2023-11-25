<!-- component -->
<div class='my-2'>
  <div class="container mx-auto flex flex-wrap overflow-hidden bg-white shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
    <div class="container mx-auto flex flex-wrap w-1/4">
      <img alt="ItemCarrito" class="w-3/4 mx-auto object-cover border-0 object-center border border-gray-200" src="{{ asset($item->elemento->imagenURL) }}">
    </div>
    <div class="w-3/4 p-5 mt-0 bg-[#5690FF]">
      <div class="grid grid-cols-2 h-1/3">

        @if ($item->tipoItem == 'Producto')   
        <a href='{{route('producto_show', $item->elemento->id)}}'>
          <h1 class="text-gray-900 text-3xl title-font font-medium mb-4 text-white hover:underline hover:hover:cursor-pointer">{{$item->elemento->nombre_producto}}&ensp;x{{$item->unidades}}</h1>
        </a>
        @else
        <a href='{{route('combo_show', $item->elemento->id_oferta_combo)}}'>
          <h1 class="text-gray-900 text-3xl title-font font-medium mb-4 text-white hover:underline hover:hover:cursor-pointer">Combo {{$item->elemento->nombre_combo}}&ensp;x{{$item->unidades}}</h1>
        </a>
        @endif

        @if ($item->tipoItem == 'Producto')
        <form method='POST' action='{{route('carrito_eliminar', ['tipoItem' => 'Producto', 'id' => $item->elemento->id])}}' class='ml-auto'>
        @else
        <form method='POST' action='{{route('carrito_eliminar', ['tipoItem' => 'Combo', 'id' => $item->elemento->id_oferta_combo])}}' class='ml-auto'>
        @endif
          @csrf
          @method('DELETE')
          <button type='submit' class='ml-auto mb-auto bg-transparent text-white bold text-3xl h-10 w-10 hover:bg-[#2769E5] inline-flex items-center justify-center rounded-full'>
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </form>

      </div>
      <div class="grid grid-cols-2 mt-auto h-2/3 items-end">
        <div>
        
        @if($item->tipoItem == 'Producto')
          @if ($item->elemento->precio_producto == $item->elemento->getPrecioDeVenta())
          <p class="title-font font-medium text-2xl text-gray-900 text-white lg:mb-0">@money($item->elemento->precio_producto * $item->unidades)</p>
          @else
          <p class="title-font font-medium text-1xl line-through text-gray-900 text-white">@money($item->elemento->precio_producto * $item->unidades)</p>
          <p class="title-font font-medium text-2xl text-gray-900 text-white lg:mb-0">@money($item->elemento->getPrecioDeVenta() * $item->unidades)</p>
          @endif
        @else
          <p class="title-font font-medium text-1xl line-through text-gray-900 text-white">@money($item->elemento->getPrecioComboSinDescuento() * $item->unidades)</p>
          <p class="title-font font-medium text-2xl text-gray-900 text-white lg:mb-0">@money($item->elemento->getPrecioCombo() * $item->unidades)</p>
        @endif

        </div>
        <div class="align-text-bottom items-end ml-auto">
          @if($item->tipoItem == 'Producto')
          <form method='POST' action='{{route('carrito_editar', ['tipoItem' => 'Producto', 'id' => $item->elemento->id])}}'>
          @else
          <form method='POST' action='{{route('carrito_editar', ['tipoItem' => 'Combo', 'id' => $item->elemento->id_oferta_combo])}}'>
          @endif
            @csrf
            @method('PATCH')
            <input type='submit' name='decremento' value='-' class='rounded-l-full bg-white hover:bg-gray-200 h-8 w-8 bold text-2xl hover:cursor-pointer'>
            <input type='number' name='unidades' value='{{$item->unidades}}' readonly class='w-14 h-8 border-0 text-2xl p-0 text-center my-auto cursor-default [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
            <input type='submit' name='incremento' value='+' class='rounded-r-full bg-white hover:bg-gray-200 h-8 w-8 bold text-2xl hover:cursor-pointer'>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>