@extends('layouts.administrativo')

@section('titulo')
Ofertas
@endsection

@section('encabezado')
Ofertas
@endsection

@section('contenido')

<h3 class='text-3xl text-left ml-1'>Ordenar</h3>
<div class="flex justify-between ml-1">
    <div>
        <select class="form-control mr-5 rounded-lg" id="tipo_oferta" name="tipoOferta">
            <option value="producto">Unitarias</option>
            <option value="ofertaCombo">Combo</option>
            <option value="ofertaMonto">Monto</option>
            <option value="ofertaMueble">Tipo Mueble</option>
        </select>
        <select class="form-control mr-5 rounded-lg" id="ordenamiento" name="campoOrden">
            <option value="fecha_inicio_oferta">Fecha Inicio Vigencia</option>
            <option value="fecha_fin_oferta">Fecha Fin Vigencia</option>
            <option value="porcentaje_descuento">Descuento</option>
        </select>
        <select class="form-control mr-5 rounded-lg" id="direccion_orden" name="direccionOrden">
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
        </select>
    </div>

    @if(Auth::user()->rol_usuario != 'gerente')
    <a href="{{ route('crear_oferta') }}" class="bg-gray-800 hover:bg-gray-600 text-white py-2 px-4 mr-1 rounded-md text-base">
        Crear Oferta
    </a>
    @endif
</div>

<div id="contenedorTablaOfertas" class="w-full">

    <div class="w-full">
        <x-custom.table :columnas="['Nombre Oferta', 'Descuento', 'Inicio de Vigencia', 'Fin de Vigencia', 'Modificacion', '']">
            @foreach ($ofertas as $oferta)
            <tr>
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{$oferta->oferta_combo && count($oferta->oferta_combo) > 0 ? $oferta->oferta_combo[0]->nombre_combo
                    :
                    ''}}
                </td>
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{$oferta->porcentaje_descuento}}%
                </td>
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{$oferta->fecha_inicio_oferta}}
                </td>
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{$oferta->fecha_fin_oferta}}
                </td>
                @if(Auth::user()->rol_usuario != 'gerente')
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left  hover:underline text-lg font-semibold text-gray-900">
                    <a href="{{ route('administrador_edit_ofertas', $oferta) }}">Modificar</a>
                </td>
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold hover:underline text-gray-900">
                    <a href="#">Eliminar</a>
                </td>
                @else 
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-500">
                    <p href="{{ route('administrador_edit_ofertas', $oferta) }}">Modificar</p>
                </td>
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-500">
                    <p href="#">Eliminar</p>
                </td>
                @endif
            </tr>
            @endforeach
        </x-custom.table>
    </div>


</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    var selectElements = document.querySelectorAll('select');

    selectElements.forEach(function(select) {
        select.addEventListener('change', function() {
            var tipoOferta = document.getElementById('tipo_oferta').value;
            var campoOrden = document.getElementById('ordenamiento').value;
            var direccionOrden = document.getElementById('direccion_orden').value;

            var baseUrl = "/ofertas";

            // URL parametros 
            var url = baseUrl +
                '?tipoOferta=' + tipoOferta +
                '&campoOrden=' + campoOrden +
                '&direccionOrden=' + direccionOrden;

            axios.get(url)
                .then(response => {
                    const ofertas = response.data.ofertas;
                    document.getElementById('contenedorTablaOfertas').innerHTML = "";
                    console.log(ofertas);

                    // Encabezados tabla
                    let tablaHTML = `
                        <div class="w-full">
                            <x-custom.table :columnas="['Nombre Oferta', 'Descuento', 'Inicio de Vigencia', 'Fin de Vigencia', 'Modificacion', '']">
                    `;

                    // cuerpo de tabla
                    ofertas.forEach(oferta => {
                        tablaHTML += `
                            <tr>
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                    ${oferta.oferta_combo && oferta.oferta_combo.length > 0 ? oferta.oferta_combo[0].nombre_combo : ''}
                                </td>
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                    ${oferta.porcentaje_descuento}%
                                </td>
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                    ${oferta.fecha_inicio_oferta}
                                </td>
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                    ${oferta.fecha_fin_oferta}
                                </td>
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                    <a href="#">Modificar</a>
                                </td>
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                                    <a href="#">Eliminar</a>
                                </td>
                            </tr>
                        `;
                    });

                    tablaHTML += `
                            </x-custom.table>
                        </div>
                    `;

                    document.getElementById('contenedorTablaOfertas').innerHTML = tablaHTML;

                })
                .catch(error => {
                    console.error(error);
                });
        });
    });
</script>
@endsection