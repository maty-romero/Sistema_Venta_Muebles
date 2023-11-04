@extends("layouts.app")
@section('content')

  <h1 class="pl-32 text-5xl pb-6 font-medium">Productos</h1>
  <div class=" flex-row px-32 pb-6">
    Filtrando por:
    Tipo producto:
    <select name="" id="">
      <option value="">Exterior</option>
      <option value="">Interior</option>
    </select>
    | Mostrando:
    <select name="" id="">
      <option value="">Todo</option>
      <option value="">Ofertas</option>
      <option value="">Combos</option>
    </select>
    | Ordenando por:
    <select name="" id="">
      <option value="">Nombre</option>
      <option value="">Precio</option>
    </select>
    <select name="" id="">
      <option value="">Asc</option>
      <option value="">Desc</option>
    </select>
  </div>

  <div class="grid grid-cols-4 px-32 pb-10 gap-x-4 ">
    @foreach ( $productos as $producto )
    <x-custom.cardProducto :producto="$producto">
    </x-custom.cardProducto>
    {{$producto->oferta}}
    @endforeach
  </div>
  <div class="flex justify-center">{{ $productos->links() }}</div>

  
@endsection