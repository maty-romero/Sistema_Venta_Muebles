@extends("layouts.app")

@section('content')

@if (session('success'))
    <a href="{{route('cliente_comprobante_compra', ['nroComprobante' => session('nroComprobante')])}}" id="link" target="_blank"></a> 
    <div class="px-32 gap-x-4 min-w-min">
        <div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div> 
    <script>
        document.getElementById('link').click();
    </script>
@endif

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