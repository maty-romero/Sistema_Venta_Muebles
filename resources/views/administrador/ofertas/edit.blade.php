@extends('layouts.administrativo')

@section('titulo')
Editar Oferta
@endsection

@section('encabezado')
Editar Oferta
@endsection

@section('contenido')
@if (session('success_oferta'))
<div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('success_oferta') }}</span>
</div>
<br>
@endif

@if (session('error_oferta'))

<div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('error_oferta') }}</span>
</div>
<br>
@endif

<form action="{{ route('administrador_update_ofertas', $oferta) }}" method="POST">
    @method('PATCH')
    @csrf

    <p class="font-poppins text-1g">Fecha inicio</p>
    <input id="fecha_inicio_oferta" type="date" class="rounded-md mb-5" name="fecha_inicio_oferta"
        value="{{ $oferta->fecha_inicio_oferta }}">
    @error('fecha_inicio_oferta')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Fecha de fin</p>
    <input id="fecha_fin_oferta" type="date" class="rounded-md mb-5" name="fecha_fin_oferta"
        value="{{ $oferta->fecha_fin_oferta }}">
    @error('fecha_fin_oferta')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Descuento</p>
    <input id="porcentaje_descuento" type="number" class="rounded-md mb-5" min="1" max="99" name="porcentaje_descuento"
        value="{{ $oferta->porcentaje_descuento }}">
    @error('porcentaje_descuento')
    <br><span style="color: red">{{ $message }}</span>
    @enderror


    <br>
    <button type="submit" class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-bash">
        Confirmar cambios
    </button>
    <br><br>
</form>

@endsection