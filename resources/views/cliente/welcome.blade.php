@extends("layouts.app")

@section('content')
<h1 class="pl-32 text-6xl pb-6 font-medium">Productos</h1>
<div class="grid grid-cols-4 px-32 gap-x-4 min-w-min">
    @foreach ( $productos as $producto )
    <x-custom.cardProducto :producto="$producto">
    </x-custom.cardProducto>
    @endforeach
</div>
@if (count($combos)>0)
<h1 class="pl-32 text-6xl pb-6 font-medium">Combos</h1>
<div class="grid grid-cols-4 px-32 gap-x-4">

    @foreach ( $combos as $combo )

    <x-custom.cardCombo :combo="$combo">
    </x-custom.cardCombo>

    @endforeach
</div>

@endif

@endsection