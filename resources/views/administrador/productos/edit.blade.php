@extends('layouts.administrativo')

@section('titulo')
Editar Producto
@endsection

@section('encabezado')
Editar producto
@endsection

@section('contenido')
@if (session('success_producto'))
<div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('success_producto') }}</span>
</div>
@endif

@if (session('error_producto'))
<div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('error_producto') }}</span>
</div>
@endif

@if (session('success_stock_precio'))
<div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('success_stock_precio') }}</span>
</div>
@endif

@if (session('error_stock_precio'))
<div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('error_stock_precio') }}</span>
</div>
@endif


<form action="{{ route('administrador_update_producto', $producto) }}" enctype="multipart/form-data" method="POST">
    @method('PATCH')
    @csrf

    <p class="font-poppins text-1g">Nombre del producto</p>
    <input id="txtNombreProducto" type="text" class="rounded-md mb-5" name="nombre_producto" value="{{ $producto->nombre_producto }}">
    @error('nombre_producto')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Descripci&oacute;n</p>
    <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md mb-5">{{ $producto->descripcion }}</textarea>
    @error('descripcion')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Precio</p>
    <input id="txtPrecio" type="number" class="rounded-md mb-5" name="precioProducto" value="{{ $producto->precio_producto }}" disabled>
    @error('precioProducto')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Tipo de Mueble</p>
    <select name="cmbTipoMueble" class="font-poppins text-1g w-[190px] rounded-md mb-5" value="{{ $producto->id_tipo_mueble }}">
        <option value="1">Exterior</option>
        <option value="2">Interior</option>
    </select>
    @error('cmbTipoMueble')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Medidas</p>
    <p class="font-poppins text-1g">Alto</p>
    <input id="txtAlto" type="number" class="rounded-md mb-5" name="alto" value="{{ $producto->alto }}">
    @error('alto')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Largo</p>
    <input id="txtLargo" type="number" class="rounded-md mb-5" name="largo" value="{{ $producto->largo }}">
    @error('largo')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Ancho</p>
    <input id="txtAncho" type="number" class="rounded-md mb-5" name="ancho" value="{{ $producto->ancho }}">
    @error('ancho')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p>Material</p>
    <select name="cmbmaterialMueble" class="font-poppins w-[190px] text-1g rounded-md mb-5">
        <option value="{{ $producto->material }}">{{Str::ucfirst($producto->material)}}</option>
        <option value="madera">Madera</option>
        <option value="acero">Acero</option>
        <option value="aluminio">Aluminio</option>
        <option value="plastico">Plastico</option>
    </select>
    @error('cmbmaterialMueble')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g">Stock</p>
    <input id="txtStockInicial" type="number" class="rounded-md " name="stockProducto" value="{{ $producto->stock }}" disabled>
    @error('stock')
    <br><span style="color: red">{{ $message }}</span>
    @enderror

    <p class="font-poppins text-1g mt-4">Imagen</p>
    <input name='imagenProd' id="imagenProd" type="file" class="mb-1 relative bg-white m-0 block w-[350px] min-w-0 flex-auto rounded border border-solid border-gray-500 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-black transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-800 file:px-3 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-600 focus:border-primary focus:shadow-te-primary focus:outline-none" />
    <p class="mb-1 font-poppins text-xs">Formato JPEG/PNG</p>
    @error('imagenProd')
    <small style="color: red">{{ $message }}</small>
    @enderror

    <br>
    <button type="submit" class="bg-gray-800 hover:bg-gray-600 text-white py-2 px-4 rounded-md text-bash">
        Confirmar cambios
    </button>
    <br><br>
</form>


<div class="relative flex flex-row">
    @component('components.custom.modal_login')
    @slot('textoBtn', 'Agregar stock')
    @slot('clasesBtn',
    'flex select-none items-center gap-2 rounded-lg py-2 px-6 text-center align-middle
    bg-gray-800 text-white hover:bg-gray-600 transition-all active:bg-gray-600 disabled:opacity-50
    disabled:shadow-none')
    @slot('encabezado', 'Ingrese los campos solicitados')
    @slot('contenido')
    <form id="idFrmPsw" method="POST" action='{{ route('producto_updateStock', $producto) }}'>
        @csrf
        <p class="font-poppins text-1g">Agregar stock</p>
        <input type="number" name="stock_producto" value='1' min='1' id="" class="rounded-md mb-5">
        <p class="font-poppins text-1g">Actualizar Precio</p>
        <input type="number" name="precio_producto" class="rounded-md mb-5" step="any" value="{{ $producto->precio_producto }}">
        <div class='mt-4 flex items-center justify-end'>
            <button type='submit' class='py-3 px-6 rounded-lg text-center font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all'>Confirmar</button>
        </div>
    </form>
    @endslot
    @endcomponent
</div>

@endsection