@extends('layouts.administrativo')

@section('titulo')
    Usuarios
@endsection

@section('encabezado')
    Usuarios
@endsection

@section('contenido')

    @php
    //'Nombre', 'Rol', 'Fecha Creacion', '', 'Moficacion', '
    /*
    $usuarios = [
        [
            'nombre' => 'Juan',
            'rol' => 'Jefe de Ventas',
            'fecha_creacion' => '12/12/12',
        ],
        [
            'nombre' => 'Pepe',
            'rol' => 'Cliente',
            'fecha_creacion' => '21/02/16',
        ],
        [
            'nombre' => 'Emma',
            'rol' => 'Cliente',
            'fecha_creacion' => '31/11/22',
        ]
    ];
    */; 
    dump($usuarios);
    //echo $usuarios[0]['name']; 
    @endphp
    

    <h3 class='text-3xl text-left ml-4'>Ordenar</h3>
    <div class="flex justify-between ml-4">
    <x-custom.filters>
        <select class="form-control mr-5 rounded-lg" id="ordenamiento">
            <option value="nombre">Nombre</option>
            <option value="rol">Rol</option>
            
        </select>
        <select class="form-control mr-5 rounded-lg" id="direccion_orden">
            <option value="ascendente">Ascendente</option>
            <option value="descendente">Descendente</option>
        </select>
        <x-custom.input-search />
    </x-custom.filters>

    <a href="{{ route('administrador_create_usuario') }}">
        <button class="bg-gray-800 text-white py-2 px-4 rounded-md text-base mt-4 mr-4">
            Crear Usuario
        </button>
    </a>
    </div>

    <div class="w-full">
    <x-custom.table :columnas="['Nombre', 'Rol', 'Fecha Creacion', '', 'Moficacion', '']">
        @foreach ($usuarios as $usuario)
            <tr>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ $usuario->name }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ $usuario->rol_usuario }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    {{ date('d-m-Y', strtotime($usuario->created_at))  }}</td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    @if ($usuario['rol'] == 'Cliente')
                        <a href="">Informe Compras</a>    
                    @endif    
                    </td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    <a href="">Modificar</a></td>
                <td
                    class="px-5 py-3 border-b-2 border-gray-500 bg-slate-100 text-left text-lg font-semibold text-gray-900">
                    <a href="">Eliminar</a></td>
            </tr>
        @endforeach
         
    </x-custom.table>
    </div>

@endsection