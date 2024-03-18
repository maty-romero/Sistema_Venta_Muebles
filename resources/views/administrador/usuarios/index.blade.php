@extends('layouts.administrativo')

@section('titulo')
    Usuarios
@endsection

@section('encabezado')
    @if (Auth::user()->rol_usuario == 'administrador')
        Usuarios
    @else
        Clientes
    @endif
@endsection

@section('contenido')
    <h3 class='text-3xl text-left ml-1 mb-1'>Ordenar</h3>
    <div class="flex justify-between ml-1">
        <form id="searchForm" name="searchForm" method="GET" action="/searchUser">

            <select class="form-control mr-5 rounded-lg" id="ordenamiento" name="ordenamiento">
                <option value="nombre"
                    {{ isset($input['ordenamiento']) && $input['ordenamiento'] === 'nombre' ? 'selected' : '' }}>
                    Nombre</option>
                <option value="rol_usuario"
                    {{ isset($input['ordenamiento']) && $input['ordenamiento'] === 'rol_usuario' ? 'selected' : '' }}>
                    Rol</option>

            </select>
            <select class="form-control mr-5 rounded-lg" id="direccion_orden" name="direccion_orden">
                <option value="asc"
                    {{ isset($input['direccion_orden']) && $input['direccion_orden'] === 'asc' ? 'selected' : '' }}>
                    Ascendente</option>
                <option value="desc"
                    {{ isset($input['direccion_orden']) && $input['direccion_orden'] === 'desc' ? 'selected' : '' }}>
                    Descendente
                </option>
            </select>
            <input id="name" name="name" value="{{ isset($input['name']) ? $input['name'] : '' }}"
                class="py-2 pl-2 rounded-lg mr-5" placeholder="Buscar usuario">

        </form>

        <a href="{{ route('administrador_create_usuario') }}">
            <button class="bg-gray-800 hover:bg-gray-600 text-white py-2 px-4 rounded-md text-base mr-1">
                Crear Usuario
            </button>
        </a>

    </div>

    <div class="w-full">

        @if (Auth::user()->rol_usuario == 'administrador')
            <x-custom.table :columnas="['Nombre', 'Rol', 'Fecha Creacion', '', 'Modificacion']">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            @if ($usuario->rol_usuario == 'cliente')
                                {{ $usuario->cliente->nombre_cliente }}
                            @else
                                {{ $usuario->name }}
                            @endif
                        </td>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            @if ($usuario->rol_usuario != 'jefe_ventas')
                                {{ Str::ucfirst($usuario->rol_usuario) }}
                            @else
                                Jefe de Ventas
                            @endif
                        </td>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            {{ date('d-m-Y', strtotime($usuario->created_at)) }}
                        </td>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            @if ($usuario->rol_usuario == 'cliente')
                                <a href="{{ route('administrador_reportes_cliente', ['id' => $usuario->id]) }}">Informe
                                    Compras</a>
                            @endif
                        </td>

                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center hover:underline text-lg font-semibold text-gray-900">
                            <div class='grid grid-cols-2'>
                                <a href="{{ route('administrador_edit_usuarios', $usuario) }}" class='mr-2 ml-auto'><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                        <path
                                            d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                    </svg>
                                </a>
                                <form action="{{ route('administrador_delete_usuarios', $usuario) }}" method="POST"
                                    class='ml-2 mr-auto'>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </x-custom.table>
        @else
            <x-custom.table :columnas="['Nombre', 'Rol', 'Fecha Creacion', '']">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            @if ($usuario->rol_usuario == 'cliente')
                                {{ $usuario->cliente->nombre_cliente }}
                            @else
                                {{ $usuario->name }}
                            @endif
                        </td>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            @if ($usuario->rol_usuario != 'jefe_ventas')
                                {{ Str::ucfirst($usuario->rol_usuario) }}
                            @else
                                Jefe de Ventas
                            @endif
                        </td>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            {{ date('d-m-Y', strtotime($usuario->created_at)) }}
                        </td>
                        <td
                            class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-center text-lg font-semibold text-gray-900">
                            @if ($usuario->rol_usuario == 'cliente')
                                <a href="{{ route('administrador_reportes_cliente', ['id' => $usuario->id]) }}">Informe
                                    Compras</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </x-custom.table>
        @endif
        
    </div>
    <div class="flex justify-center">{{ $usuarios->links() }}</div>

    <script src="{{ asset('js/selectUsuarioHandler.js') }}"></script>

    <!--Post::withTrashed()->find($post_id)->restore();-->
@endsection
