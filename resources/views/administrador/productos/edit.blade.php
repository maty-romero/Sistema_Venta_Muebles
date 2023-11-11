@extends('layouts.administrativo')

@section('titulo')
    Editar Producto
@endsection
 @section('encabezado')
    Editar producto
@endsection

@section('contenido')
    <form action="{{ route('producto.update', $producto) }}" method="POST">
        @method('PUT')
    @csrf
        <p class="font-poppins text-1g">Nombre del producto</p>
        <input id="txtNombreProducto" type="text" class="rounded-md mb-5" name="nombreProducto" value="{{ $producto->nombre_producto }}">

        <p class="font-poppins text-1g">Descripci&oacute;n</p>

        <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md mb-5">{{ $producto->descripcion }}</textarea>
        <p class="font-poppins text-1g">Precio</p>
        <input id="txtPrecio" type="number" class="rounded-md mb-5" name="precio" value="{{ $producto->precio_producto }}">

        <p class="font-poppins text-1g">Tipo de Mueble</p>
        <select name="cmbTipoMueble" class="font-poppins text-1g rounded-md mb-5" value="{{ $producto->id_tipo_mueble }}">
            <option value="1">Exterior</option>
            <option value="2">Interior</option>
        </select>

        <p class="font-poppins text-1g">Medidas</p>
        <p class="font-poppins text-1g">Alto</p>
        <input id="txtAlto" type="number" class="rounded-md mb-5" name="alto" value="{{ $producto->alto }}">
        <p class="font-poppins text-1g">Largo</p>
        <input id="txtLargo" type="number" class="rounded-md mb-5" name="largo" value="{{ $producto->largo }}">
        <p class="font-poppins text-1g">Ancho</p>
        <input id="txtAncho" type="number" class="rounded-md mb-5" name="ancho" value="{{ $producto->ancho }}">
        <br>
        <p>Material</p>
        <select name="cmbmaterialMueble" class="font-poppins text-1g rounded-md mb-5" value="{{ $producto->material }}">
            <option value="madera" >Madera</option>
            <option value="acero" >Acero</option>
            <option value="aluminio" >Aluminio</option>
            <option value="Plastico" >Plastico</option>
        </select>
        
        <p class="font-poppins text-1g">Stock</p>
        <input id="txtStockInicial" type="number" class="rounded-md mb-5" name="stock" value="{{ $producto->stock }}"disabled>
        'boton de actualizar stock - proximamente'
        <br>
        <button type="submit" class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-bash">
            Editar producto
        </button>
    </form>
@endsection