@extends('layouts.administrativo')

@section('titulo')
    Crear Producto
@endsection

@section('encabezado')
    Crear producto
@endsection

@section('contenido')
    <form action="{{ route('administrador_store_producto') }}" enctype="multipart/form-data" method="POST">
    @csrf
        <p class="font-poppins text-1g">Nombre del producto</p>
        <input id="txtNombreProducto" type="text" class="rounded-md mb-5" name="nombreProducto">

        <p class="font-poppins text-1g">Descripción</p>
        <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md w-64 mb-5"></textarea>

        <p class="font-poppins text-1g">Precio</p>
        <input id="txtPrecio" type="number" class="rounded-md mb-5" name="precio">

        <p class="font-poppins text-1g">Tipo de Mueble</p>
        <select name="cmbTipoMueble" class="font-poppins text-1g rounded-md mb-5">
            <option value="1">Exterior</option>
            <option value="2" selected>Interior</option>
        </select>

        <p class="font-poppins text-1g">Medidas</p>
        <p class="font-poppins text-1g">Alto</p>
        <input id="txtAlto" type="number" class="rounded-md mb-5" name="alto">
        <p class="font-poppins text-1g">Largo</p>
        <input id="txtLargo" type="number" class="rounded-md mb-5" name="largo">
        <p class="font-poppins text-1g">Ancho</p>
        <input id="txtAncho" type="number" class="rounded-md mb-5" name="ancho">
        <br>
        <p>Material</p>
        <select name="cmbMaterialMueble" class="font-poppins text-1g rounded-md mb-5">
            <option value="madera" >Madera</option>
            <option value="acero" >Acero</option>
            <option value="aluminio" >Aluminio</option>
            <option value="Plastico" >Plastico</option>
        </select>

        <p class="font-poppins text-1g">Stock inicial</p>
        <input id="txtStockInicial" type="number" class="rounded-md mb-5" name="stockInical">
        <br>

        <p class="font-poppins text-1g">Imagen</p>
        <input name='imagenProd' id="imagenProd" type="file" class="mb-1 relative bg-white m-0 block w-[350px] min-w-0 flex-auto rounded border border-solid border-gray-500 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-black transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-800 file:px-3 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-600 focus:border-primary focus:shadow-te-primary focus:outline-none"/>
        <p class="mb-5 font-poppins text-xs">Formato JPEG/PNG</p>

        <button type="submit" class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-bash">
            Crear producto
        </button>
    </form>
    
@endsection