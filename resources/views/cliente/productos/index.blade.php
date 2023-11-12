@extends("layouts.app")
@section('content')



<x-custom.filters :tipoMueble="$tipoMueble" :filtro="$filtro" :ordenCriterio="$ordenCriterio" :orden="$orden">
</x-custom.filters>
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

<div class="flex justify-center">{{$resultados->links()}}</div>

<script src="{{asset('js/searchProductHandler.js')}}"></script>

@endsection