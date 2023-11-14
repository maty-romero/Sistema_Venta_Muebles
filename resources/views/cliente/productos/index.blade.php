@extends("layouts.app")
@section('content')


<div class="px-32 pb-12">
  <x-custom.filters :tipoMueble="$tipoMueble" :filtro="$filtro" :ordenCriterio="$ordenCriterio" :orden="$orden">
  </x-custom.filters>
</div>
@if (empty($resultados->items()))
<div class="px-32 pb-12">
  <p class="text-xl font-medium"> No se encontraron resultados.</p>
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