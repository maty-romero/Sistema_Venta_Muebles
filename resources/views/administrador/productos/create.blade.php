@extends('layouts.administrativo')

@section('titulo')
Crear Producto
@endsection

@section('encabezado')
Crear producto
@endsection

@section('contenido')
@if (session('success'))
<div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

@if (session('error'))
<div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{ session('error') }}</span>
</div>
@endif

<form action="{{ route('administrador_store_producto') }}" enctype="multipart/form-data" method="POST" class="grid grid-cols-3 ">
    @csrf

    <table>
        <tr>
            <td>
                <p class="font-poppins text-1g">Nombre del producto</p>
                <input id="txtNombreProducto" type="text" class="rounded-md mb-5 mr-5" name="nombre_producto">
                @error('nombre_producto')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
            <td>
                <p class="font-poppins text-1g">Precio</p>
                <div class="relative w-[190px] mr-5">
                    <div class="absolute mt-[2px] top-0 start-0 p-2.5 text-sm font-medium h-full rounded-s-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <input id="txtPrecio" type="text" class="pl-8 rounded-md mb-5 w-[190px]" name="precio_producto" pattern="-?[0-9]+([\.,][0-9]{1,2})?" />
                    @error('precio_producto')
                    <br><small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
            </td>
            <td>
                <p class="font-poppins text-1g">Stock inicial</p>
                <input id="txtStockInicial" type="number" class="rounded-md mb-5 mr-5" name="stock" min="0" step="1" />
                @error('stock')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
        </tr>
    
        <tr>
            <td colspan="2">
                <p class="font-poppins text-1g">Descripción</p>
                <textarea id="txtDescripcion" name="descripcion" rows="3" cols="40" class="resize-none rounded-md mb-5"></textarea>
                @error('descripcion')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
        </tr>
    
        <tr>
            <td>
                <p class="font-poppins text-1g">Tipo de Mueble</p>
                <select name="id_tipo_mueble" class="font-poppins text-1g w-[190px] rounded-md mb-5">
                    <option value="1">Exterior</option>
                    <option value="2">Interior</option>
                </select>
                @error('id_tipo_mueble')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
            <td>
                <p>Material</p>
                <select name="material" class="font-poppins w-[190px] text-1g rounded-md mr-5 mb-5">
                    <option value="madera">Madera</option>
                    <option value="acero">Acero</option>
                    <option value="aluminio">Aluminio</option>
                    <option value="plastico">Plastico</option>
                </select>
                @error('material')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
        </tr>
    
        <tr>
            <td>
                <p class="font-poppins text-1g">Medidas [cm]</p>
                <p class="font-poppins text-1g">Alto</p>
                <input id="txtAlto" type="text" class="rounded-md mb-6 mr-10" name="alto" pattern="-?[0-9]+([\.,][0-9]{1,2})?" />
                @error('alto')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
            <td>
                <p class="font-poppins text-1g">Largo</p>
                <input id="txtLargo" type="text" class="rounded-md mb-0 mr-10" name="largo" pattern="-?[0-9]+([\.,][0-9]{1,2})?" />
                @error('largo')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
            <td>
                <p class="font-poppins text-1g">Ancho</p>
                <input id="txtAncho" type="text" class="rounded-md mb-0 mr-10" name="ancho" pattern="-?[0-9]+([\.,][0-9]{1,2})?" />
                @error('ancho')
                <br><small style="color: red">{{ $message }}</small>
                @enderror
            </td>
        </tr>
    
        <tr>
            <td colspan="3">
                <p class="font-poppins text-1g">Imagen</p>
                <input name='imagenProd' id="imagenProd" type="file" class="mb-1 relative bg-white m-0 block w-[350px] min-w-0 flex-auto rounded border border-solid border-gray-500 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-black transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-gray-800 file:px-3 file:py-[0.32rem] file:text-white file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-gray-600 focus:border-primary focus:shadow-te-primary focus:outline-none" />
                <p class="mb-5 font-poppins text-xs">Formato JPEG/PNG</p>
                @error('imagenProd')
                <small style="color: red">{{ $message }}</small>
                @enderror
            </td>
        </tr>
    
        <tr>
            <td>
                <button type="submit" class="mt-5 bg-gray-800 text-white py-2 px-4 rounded-md text-bash">
                    Crear producto
                </button>
            </td>
        </tr>
    </table>
    
</form>
@endsection