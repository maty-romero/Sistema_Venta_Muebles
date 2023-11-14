@extends('layouts.administrativo')

@section('titulo')
Usuarios
@endsection

@section('encabezado')
Usuarios
@endsection

@section('contenido')
@php
//dump($usuarios);
@endphp


<h3 class='text-3xl text-left ml-4'>Ordenar</h3>
<div class="flex justify-between ml-4">
    <form id="searchForm" name="searchForm" method="GET" action="/searchUser">

        <select class="form-control mr-5 rounded-lg" id="ordenamiento" name="ordenamiento">
            <option value="nombre" {{ isset($input['ordenamiento']) && $input['ordenamiento']==="nombre"
                ?"selected":""}}>
                Nombre</option>
            <option value="rol_usuario" {{ isset($input['ordenamiento']) && $input['ordenamiento']==="rol_usuario"
                ?"selected":""}}>Rol</option>

        </select>
        <select class="form-control mr-5 rounded-lg" id="direccion_orden" name="direccion_orden">
            <option value="asc" {{ isset($input['direccion_orden']) && $input['direccion_orden']==="asc"
                ?"selected":""}}>
                Ascendente</option>
            <option value="desc" {{ isset($input['direccion_orden']) && $input['direccion_orden']==="desc"
                ?"selected":""}}>Descendente
            </option>
        </select>
        <input id="name" name="name" value="{{isset($input['name'])?$input['name']:''}}"
            class="py-1 pl-2 rounded-lg border-gray-200" placeholder="Buscar producto">

    </form>

    <a href="{{ route('administrador_create_usuario') }}">
        <button class="bg-gray-800 hover:bg-gray-600 text-white py-2 px-4 rounded-md text-base mt-4 mr-4">
            Crear Usuario
        </button>
    </a>

</div>

<div class="w-full">
    <x-custom.table :columnas="['Nombre', 'Rol', 'Fecha Creacion', '', 'Moficacion', '']">
        @foreach ($usuarios as $usuario)
        <tr>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                {{ $usuario->name }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                {{ $usuario->rol_usuario }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                {{ date('d-m-Y', strtotime($usuario->created_at)) }}
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                @if ($usuario->rol_usuario == 'cliente')
                <a href="">Informe Compras</a>
                @endif
            </td>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                <a href="{{ route('usuario.edit', $usuario) }}">Editar</a>
            <td class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                <form action="{{ route('usuario.destroy', $usuario) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
        </tr>
        @endforeach

    </x-custom.table>
</div>
<div class="flex justify-center">{{ $usuarios->links() }}</div>

<script src="{{asset('js/selectUsuarioHandler.js')}}"></script>
@endsection