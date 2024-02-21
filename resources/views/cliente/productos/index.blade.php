@extends("layouts.app")
@section('content')


<div class="px-32 pb-12">
  <x-custom.filters :name="$name" :tipoMueble="$tipoMueble" :filtro="$filtro" :ordenCriterio="$ordenCriterio" :orden="$orden">
  </x-custom.filters>
</div>
@if (empty($resultados->items()))
<div class="px-32 pb-12">
  <div class="container w-3/4 mt-2 mx-auto mb-1 bg-[#5690FF] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
    <p class='w-full py-20 text-white font-bold text-2xl text-center'>No se encontraron resultados</p>
</div>
</div>
@else
<div id="containerResultados" class=" grid grid-cols-4 px-32 pb-10 gap-x-4 ">
  @foreach ( $resultados as $item )
  @if (isset($item->nombre_producto))
  <x-custom.cardProducto :producto="$item">
  </x-custom.cardProducto>
  @else
  <x-custom.cardCombo :combo="$item">
  </x-custom.cardCombo>
  @endif
  @endforeach
</div>
@endif




<div class="flex justify-center">{{$resultados->links()}}</div>

<script src="{{asset('js/searchProductHandler.js')}}"></script>

@endsection