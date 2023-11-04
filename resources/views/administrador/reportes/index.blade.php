@extends('layouts.administrativo')

@section('titulo')
    Reportes
@endsection

@section('encabezado')
    Reportes
@endsection

@section('contenido')



 
<form method="POST" action='{{route("reporteRedirect")}}' target="_blank">
    @csrf

<h1 class=" text-2xl pb-2 font-medium">Tipo de reporte</h1>

<select class="rounded-lg border-gray-200  mb-6" name="tipoReporte" id="tipoReporte">
    <option value="VC">Venta cliente</option>
    <option value="PMV">Productos más vendidos</option>
    <option value="OMV">Ofertas más vendidas</option>
</select>

<h1 class=" text-2xl pb-2 font-medium">Fecha</h1>

<div id="input-container" class="flex flex-row gap-6 mb-6">
    <div class="flex flex-col">
        <label for="fechaInicio">Fecha de inicio</label>
        <input class="rounded-lg border-gray-200" type="date" name="fechaInicio" id="fechaInicio">
    </div>
    <div class="flex flex-col">
        <label for="fechaFin">Fecha de fin</label> 
        <input class="rounded-lg border-gray-200" type="date" name="fechaFin" id="fechaFin">
    </div>
    <div class="flex flex-col">
        <label for="idCliente">Identificador de cliente</label>
        <input class="rounded-lg border-gray-200" type="text" name="idCliente" id="idCliente">   
    </div>
</div>

<button class="rounded-lg bg-[#3E3E3E] text-white px-4 py-2" type="submit">Generar reporte</button>
</form>



<script src="{{asset("js/reporteSelect.js")}}"></script>
@endsection


