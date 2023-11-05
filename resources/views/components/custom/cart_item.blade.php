<!-- component -->
<section class="text-gray-700 body-font overflow-hidden">
  @if(!empty($carrito))

  @foreach ($carrito as $item)

  <div class="container mx-auto flex flex-wrap mb-1 overflow-hidden bg-white shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
    <div class="container mx-auto flex flex-wrap w-1/4">
      <img alt="ecommerce" class="w-3/4 mx-auto object-cover border-0 object-center rounded border border-gray-200" src="https://www.whitmorerarebooks.com/pictures/medium/2465.jpg">
    </div>
    <div class="w-3/4 p-5 mt-0 bg-[#5690FF]">
      <div class="grid grid-cols-2 h-1/3">
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-4 text-white">{{$item->nombre_producto}}&ensp;x{{$item->unidades}}</h1>

        <form method='POST' action='{{route('carrito_eliminar', $item->id)}}' class='ml-auto'>
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

          @if ($item->precio_producto == $item->getPrecioDeVenta())
          <p class="title-font font-medium text-2xl text-gray-900 text-white lg:mb-0">@money($item->precio_producto)</p>
          @else
          <p class="title-font font-medium text-1xl line-through text-gray-900 text-white">@money($item->precio_producto)</p>
          <p class="title-font font-medium text-2xl text-gray-900 text-white lg:mb-0">@money($item->getPrecioDeVenta())</p>
          @endif

        </div>
        <div class="align-text-bottom items-end ml-auto">
          <form method='POST' action='{{route('carrito_editar', $item)}}'>
            @csrf
            @method('PATCH')
            <input type='submit' name='decremento' value='-' class='rounded-l-full bg-white hover:bg-gray-200 h-8 w-8 bold text-2xl'>
            <input type='number' name='unidades' value='{{$item->unidades}}' readonly class='w-14 h-8 border-0 text-2xl p-0 text-center my-auto cursor-default [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none'>
            <input type='submit' name='incremento' value='+' class='rounded-r-full bg-white hover:bg-gray-200 h-8 w-8 bold text-2xl'>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @else
  <div class="container mx-auto flex flex-wrap mb-1 overflow-hidden bg-[#5690FF] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
    <p class='w-full py-20 text-white font-bold text-2xl text-center'>El carrito de compras est&aacute; vac&iacute;o</p>
  </div>
  @endif
</section>