<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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


    <form action="{{ route('administrador_update_producto', $producto) }}" method="POST">
        @method('PATCH')
        @csrf

        <p class="font-poppins text-1g">Nombre del producto</p>
        <input id="txtNombreProducto" type="text" class="rounded-md mb-5" name="nombreProducto"
            value="{{ $producto->nombre_producto }}">
        @error('nombreProducto')
            <br><span style="color: red">{{ $message }}</span>
        @enderror

        <p class="font-poppins text-1g">Descripci&oacute;n</p>
        <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md mb-5">{{ $producto->descripcion }}</textarea>
        @error('descripcion')
            <br><span style="color: red">{{ $message }}</span>
        @enderror

        <p class="font-poppins text-1g">Precio</p>
        <input id="txtPrecio" type="number" class="rounded-md mb-5" name="precioProducto"
            value="{{ $producto->precio_producto }}" disabled>
        @error('precioProducto')
            <br><span style="color: red">{{ $message }}</span>
        @enderror

        <p class="font-poppins text-1g">Tipo de Mueble</p>
        <select name="cmbTipoMueble" class="font-poppins text-1g rounded-md mb-5" value="{{ $producto->id_tipo_mueble }}">
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
        <select name="cmbmaterialMueble" class="font-poppins text-1g rounded-md mb-5" value="{{ $producto->material }}">
            <option value="madera">Madera</option>
            <option value="acero">Acero</option>
            <option value="aluminio">Aluminio</option>
            <option value="Plastico">Plastico</option>
        </select>
        @error('cmbmaterialMueble')
            <br><span style="color: red">{{ $message }}</span>
        @enderror

        <p class="font-poppins text-1g">Stock</p>
        <input id="txtStockInicial" type="number" class="rounded-md " name="stock" value="{{ $producto->stock }}"
            disabled>
        @error('stock')
            <br><span style="color: red">{{ $message }}</span>
        @enderror

        <br>
        <button type="submit" class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-bash">
            Confirmar cambios
        </button>
        <br><br>
    </form>


    <div class="relative flex flex-row">
        @component('components.custom.modal_login')
            @slot('textoBtn', 'Actualizar stock producto')
            @slot('clasesBtn',
                'flex select-none items-center gap-2 rounded-lg py-3 px-6 text-center align-middle font-sans
                text-sm font-bold bg-gray-500 text-white hover:bg-gray-500 transition-all active:bg-gray-600 disabled:opacity-50
                disabled:shadow-none')
                @slot('encabezado', 'Ingrese los campos solicitados')
                @slot('contenido')
                    <form id="idFrmPsw" method="POST" action='{{ route('producto_updateStock', $producto) }}'>
                        @csrf
                        <p class="font-poppins text-1g">Agregar stock</p>
                        <input type="number" name="stock" value='1' min='1' id="" class="rounded-md mb-5">
                        <p class="font-poppins text-1g">Actualizar Precio</p>
                        <input type="number" name="precio"  class="rounded-md mb-5"
                            value="{{ $producto->precio_producto }}">
                        <div class='mt-4 flex items-center justify-end'>
                            <button type='submit'
                                class='py-3 px-6 rounded-lg text-center font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all'>Confirmar</button>
                        </div>
                    </form>
                @endslot
            @endcomponent
        </div>
    @endsection
