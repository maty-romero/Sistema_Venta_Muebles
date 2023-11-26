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
                    <a href="{{ route('administrador_edit_ofertas', $oferta) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                            <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                        </svg></a>
                </td>
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left  hover:underline text-lg font-semibold text-gray-900">

                    <form action="{{ route('administrador_delete_ofertas', $oferta) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </td>

                @else
                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-500">
                    <p href="{{ route('administrador_edit_ofertas', $oferta) }}">Modificar</p>
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
                    const rol = response.data.rol;
                    document.getElementById('contenedorTablaOfertas').innerHTML = "";
                    //  console.log(ofertas);


                    // Encabezados tabla
                    let tablaHTML;




                    // cuerpo de tabla
                    tablaHTML = `
                         <div class="w-full">
                                        <x-custom.table :columnas="['Nombre Oferta', 'Descuento', 'Inicio de Vigencia', 'Fin de Vigencia', 'Modificacion','']">`;

                    if (rol == "administrador") {

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
                           
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left  hover:underline text-lg font-semibold text-gray-900">
                    <a href="{{ route('administrador_edit_ofertas', $oferta) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                            <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                        </svg></a>
                </td>
                                
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left  hover:underline text-lg font-semibold text-gray-900">
                                <form action='/ofertas/eliminar/${oferta.id}' method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                                </svg>
                                    </button>
                                  </form>
                                </td>
                            </tr>
                        `;
                        });
                    } else {

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
                                <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left  hover:underline text-lg font-semibold text-gray-900">
                    <a href="{{ route('administrador_edit_ofertas', $oferta) }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                            <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                        </svg></a>
                </td>
                                <td></td>
                            </tr>
                        `;
                        });
                    }




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