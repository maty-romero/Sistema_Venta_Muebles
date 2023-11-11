@extends('layouts.administrativo')

@section('titulo')
    Productos
@endsection

@section('encabezado')
    
@endsection

@section('contenido')
<h1>Prductos</h1>
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
<a href="{{ route('producto.create') }}">Crear producto</a>
<div>
    <table>
        <tr>
            <td>Nombre</td>
            <td>Tipo</td>
            <td>Discontinuado</td>
            <td>Precio</td>
            <td>stock</td>
            <td>Modificacion</td>
        </tr>
        @foreach ( $productos as $producto )
        <tr>
        <td>{{$producto-> nombre_producto}}</td>
        <td>@if($producto-> id_tipo_mueble =='1')
    <p>Exterior</p>
    @else 
    <p>Interior</p>
    @endif
        </td>
        <td>@if($producto-> discontinuado =='1')
    <input type="radio"checked="checked" disabled/>
    @else 
    <input type="radio" disabled/>
    @endif</td>
        <td>{{$producto-> precio_producto}}</td>
        <td>{{$producto-> stock}}</td>
        <td>
        <a href="{{ route('producto.edit', $producto) }}">Editar</a>
            <form action="{{ route('producto.destroy', $producto) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
        </tr>
        @endforeach
    </table>
    {{ $productos->links() }}
</div>

@endsection
