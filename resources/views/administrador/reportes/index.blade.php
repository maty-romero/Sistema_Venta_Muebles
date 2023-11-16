@extends('layouts.administrativo')

@section('titulo')
Reportes
@endsection

@section('encabezado')
Reportes
@endsection

@section('contenido')




<form id="formReporte" method="post" action="{{route('reporteRedirect')}}" target="_blank">
    @csrf
    <h1 class=" text-2xl pb-2 font-medium">Tipo de reporte</h1>

    <select class="rounded-lg border-gray-600 mb-6" name="tipoReporte" id="tipoReporte">
        <option value="VC">Venta cliente</option>
        <option value="PMV">Productos más vendidos</option>
        <option value="OMV">Ofertas más vendidas</option>
    </select>

    <h1 class=" text-2xl pb-2 font-medium">Fecha</h1>

    <div id="input-container" class="flex flex-row gap-6 mb-6">
        <div class="flex flex-col">
            <label for="fechaInicio">Fecha de inicio</label>
            <input class="rounded-lg border-gray-600" type="date" name="fechaInicio" id="fechaInicio" required>
        </div>
        <div class="flex flex-col">
            <label for="fechaFin">Fecha de fin</label>
            <input class="rounded-lg border-gray-600" type="date" name="fechaFin" id="fechaFin" required>
        </div>

        <div class="flex flex-col">
            <label for="idCliente">Identificador de cliente</label>
            <select class="rounded-lg border-gray-600" name="idCliente" id="idCliente" required>
                @foreach ( $usuarios as $usuario)
                <option value='{{$usuario->id}}' {{$id==$usuario->id?"selected":""}}>{{$usuario->name}}</option>
                @endforeach
            </select>

        </div>

    </div>
    <span id="error-reporte" class="text-red-500 mb-10"></span>
    <br>
    <button class="rounded-lg bg-[#3E3E3E] text-white px-4 py-2 mt-4" type="submit">Generar reporte</button>
</form>



<script src="{{asset("js/reporteSelect.js")}}"></script>

@endsection