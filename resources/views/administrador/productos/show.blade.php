@extends('layouts.administrativo')

@section('titulo')
Productos
@endsection

@section('encabezado')
Productos
@endsection

@section('contenido')

    <div class='mt-10 pb-10 w-full'>
        <section class="text-gray-700 body-font overflow-hidden bg-white shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
            <div class="container mx-auto flex flex-wrap">
              <div class="container mx-auto flex flex-wrap w-1/2">
                <img alt="{{$producto->nombre_producto}}" class="lg:w-3/4 mx-auto object-cover border-0 object-center rounded border border-gray-200" src="{{ asset($producto->imagenURL) }}">
              </div>
              <div class="lg:w-1/2 w-full lg:px-10 lg:py-6 py-6 px-5 lg:mt-0 bg-[#343B53]">
                <div class='grid grid-cols-2'>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-2 text-white">#{{$producto->id}} {{$producto->nombre_producto}}</h1>
                    @if($producto->discontinuado)
                    <h1 class="text-gray-900 text-3xl title-font font-medium text-right text-white">Discontinuado</h1>  
                    @endif  
                </div>
                <div class='w-fit'>
                  <p class="font-medium text-2xl text-gray-900 text-white mr-3">Precio de venta: @money($producto->getPrecioDeVenta())</p>
                  @if($producto->getPrecioDeVenta() != $producto->precio_producto)
                    <p class="font-medium text-2xl text-gray-900 text-white">Precio base: @money($producto->precio_producto)</p>
                  @endif
                  <p class="font-medium text-2xl text-gray-900 text-white mr-3">Stock actual: {{$producto->stock}}</p>
                </div>
                <p class="leading-relaxed flex mt-2 items-center text-white">Descripci&oacute;n: {{$producto->descripcion}}</p>
                <p class="text-gray-900 text-1xl text-white">Mueble de {{Str::ucfirst($producto->tipo_mueble->nombre_tipo_mueble)}}</p>
                <p class="text-gray-900 text-1xl text-white">Material: {{Str::ucfirst($producto->material)}}</p>
                <p class='pb-4 text-white'>Medidas:&emsp; Ancho: {{$producto->ancho}}cm&emsp;Largo: {{$producto->largo}}cm&emsp;Alto: {{$producto->alto}}cm</p>
              </div>
            </div>
        </section>
    </div>

@endsection