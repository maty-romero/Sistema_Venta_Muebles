@extends('layouts.administrativo')

@section('titulo')
Oferta {{$oferta->getTipoOferta()}}
@endsection

@section('encabezado')
Ofertas
@endsection

@section('contenido')

<table>
    <h3 class='text-3xl text-left mb-4 ml-1'>Oferta {{$oferta->getTipoOferta()}}</h3>
    <tr><td>
        <p class="font-poppins text-1g">Fecha inicio</p>
        <input id="fecha_inicio_oferta" type="date" class="rounded-md mb-5 mr-4 w-[150px]" disabled
            value="{{ $oferta->fecha_inicio_oferta }}">
    </td>

    <td>
        <p class="font-poppins text-1g">Fecha de fin</p>
        <input id="fecha_fin_oferta" type="date" class="rounded-md mb-5 w-[150px]" disabled
            value="{{ $oferta->fecha_fin_oferta }}">
    </td></tr>

    <tr><td>
        <p class="font-poppins text-1g">Descuento</p>
        <input id="porcentaje_descuento" type="text" class="rounded-md mb-5 w-[150px]" disabled
            value="{{ $oferta->porcentaje_descuento }}%">
    </td></tr>
    @if($tipoOferta == 'Unitaria')
    <tr><td colspan="2">
        <p class="font-poppins text-1g">Producto en oferta</p>
        <input type="text" class="rounded-md mb-5 w-[200px]" disabled
            value="{{$oferta->producto[0]->nombre_producto}}">
    </td></tr>
    @elseif($tipoOferta == 'Monto')
    <tr><td colspan="2">
        <p class="font-poppins text-1g">Monto necesario para descuento</p>
        <input type="text" class="rounded-md mb-5" disabled
            value="@money($oferta->ofertaMonto[0]->monto_limite_descuento)">
    </td></tr>
    @elseif($tipoOferta == 'Tipo')
    <tr><td colspan="2">
        <p class="font-poppins text-1g">Tipo de mueble</p>
        <input type="text" class="rounded-md mb-5" disabled
            value="{{$oferta->getTipoOferta()}}">
    </td></tr>
    @elseif($tipoOferta == 'Combo')
    <tr><td>
        <p class="font-poppins text-1g">Nombre del combo</p>
        <input type="text" class="rounded-md mb-5 mr-4" disabled
            value="{{$oferta->ofertaCombo[0]->nombre_combo}}">
    </td>
    <td>
        <p class="font-poppins text-1g">Precio total</p>
        <input type="text" class="rounded-md mb-5 w-[160px]" disabled
            value="@money($oferta->ofertaCombo[0]->getPrecioCombo())">
    </td></tr>

    <tr><td colspan="2">
    <p class="font-poppins text-1g">Productos del combo</p>
    <p class="rounded-md mb-5 w-[200px] text-left bg-white py-2 border-gray-500 border-solid border">
        @foreach ($oferta->ofertaCombo[0]->oferta_combo_producto as $item)
            &nbsp;&nbsp;- {{$item->nombre_producto}} x{{$item->pivot->cantidad_producto_combo}}<br>
        @endforeach
    </p>
    </td></tr>
    @endif
    @if(Auth::user()->rol_usuario != 'gerente')
    <tr><td>
        <p class='mt-2 mb-4'>
            <a href="{{ route('administrador_edit_ofertas', $oferta) }}" class="bg-gray-800 hover:bg-gray-600 text-white py-3 px-8 rounded-md font-medium">Editar</a>
        </p>
    </td></tr>
    @endif
</table>

@endsection