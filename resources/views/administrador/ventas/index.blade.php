@extends('layouts.administrativo')

@section('titulo')
    Ventas
@endsection

@section('encabezado')
    
@endsection

@section('contenido')
<h1>Ventas</h1>
<h2>Ordenar</h2>
<select name="select1">
  <option value="Nombre" >Alfabeticamente</option>
  <option value="Personeria">Personeria</option>
  <option value="Precio">Precio</option>
  <option value="Fecha" selected>Fecha</option>
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
            <td>Comprador</td>
            <td>Personeria</td>
            <td>Total</td>
            <td>Fecha</td>
            <td>Modificacion</td>
        </tr>
        @foreach ( $ventas as $venta )
        <tr>
        <td>{{$venta-> domicilio_destino}}</td>
        <td>{{$venta-> fecha_venta}}</td>
        <td>{{$venta-> monto_final_venta}}</td>
        <td>{{$venta-> fecha_venta}}</td>
        </tr>
        @endforeach
    </table>
    {{ $ventas->links() }}
</div>
@endsection