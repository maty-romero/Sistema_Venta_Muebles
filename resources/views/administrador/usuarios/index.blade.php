@extends('layouts.administrativo')

@section('titulo')
    Usuarios
@endsection

@section('encabezado')
    Usuarios
@endsection

@section('contenido')
<h2>Ordenar</h2>
<select name="select1">
  <option value="Nombre" selected>Alfabeticamente</option>
  <option value="Precio">Precio</option>
  <option value="Fecha">Fecha</option>
</select>
<select name="select2">
  <option value="Acendente" selected>Acendente</option>
  <option value="Decendente">Decendente</option>
</select>
<input type="text">
<a href="{{ route('usuario.create') }}">Crear usuario</a>
<div>
<div>
    <table>
        <tr>
            <td>Nombre</td>
            <td>Rol</td>
            <td>Fecha creacion</td>
            <td>Modificacion</td>
        </tr>
        @foreach ( $usuarios as $user )
        <tr>
        <td>{{$user-> name}}</td>
        <td>{{$user-> rol_usuario}}</td>
        <td>{{$user-> created_at}}</td>
        <td>
        <a href="{{ route('usuario.edit', $user) }}">Editar</a>
            <form action="{{ route('usuario.destroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
        </tr>
        @endforeach
    </table>
    {{ $usuarios->links() }}
</div>
@endsection