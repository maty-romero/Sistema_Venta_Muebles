@extends('layouts.administrativo')

@section('titulo')
    Ofertas
@endsection

@section('encabezado')
    Ofertas
@endsection

@section('contenido')
<h1>Usuarios</h1>
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
        
        </tr>
        @endforeach
    </table>
    {{ $usuarios->links() }}
@endsection