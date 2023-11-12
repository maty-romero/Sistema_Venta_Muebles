@extends("layouts.app")
@section('content')


<h1 class="pl-32 text-5xl pb-6 font-medium">Productos</h1>
<div id="extraFields" class="filter-container flex-row px-32 pb-6">
  Filtrando por:
  Tipo producto:
  <select name="tipoMueble" id="tipoMueble">
    <option value="ext" {{isset($tipoMueble)&& $tipoMueble==="1" ?"selected":""}}>Exterior</option>
    <option value="int" {{isset($tipoMueble)&&$tipoMueble==="2" ?"selected":""}}>Interior</option>
  </select>
  | Mostrando:
  <select name="filtro" id="filtro">
    <option value="todo" {{ isset($filtro) && $filtro==="todo" ?"selected":""}}>Todo</option>
    <option value="productos" {{ isset($filtro) && $filtro==="productos" ?"selected":""}}>Productos</option>
    <option value="combos" {{ isset($filtro) && $filtro==="combos" ?"selected":""}}>Combos</option>
  </select>
  | Ordenando por:
  <select name="ordenCriterio" id="ordenCriterio">
    <option value="nombre" {{ isset($ordenCriterio) && $ordenCriterio==="nombre_producto" ?"selected":""}}>Nombre
    </option>
    <option value="precio" {{ isset($ordenCriterio) && $ordenCriterio==="precio_producto" ?"selected":""}}>Precio
    </option>
  </select>
  <select name="orden" id="orden">
    <option value="asc" {{ isset($orden) && $orden==="1" ?"selected":""}}>Asc</option>
    <option value="desc" {{ isset($orden) && $orden==="2" ?"selected":""}}>Desc</option>
  </select>
</div>
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