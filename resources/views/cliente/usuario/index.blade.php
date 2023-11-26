{{-- Pefil del usuario --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Perfil Cliente</title>

</head>
<body class="antialiased bg-[#FFE794] bg-pattern-image">
    <x-custom.navbar_client>
    </x-custom.navbar_client>
    <br><br>

    <div id="infoCliente" class="container mx-auto bg-white rounded-2xl p-6">
        <h3 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Perfil del cliente</h3>
        
        @if (session('success_psw'))
            <div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success_psw') }}</span>
            </div>    
        @endif

        @if (session('error_psw'))
            <div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error_psw') }}</span>
            </div>   
        @endif

        @if (session('success_datos'))
            <div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success_datos') }}</span>
            </div>    
        @endif

        @if (session('error_datos'))
            <div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error_datos') }}</span>
            </div>   
        @endif
        
        <form action="{{ route('cliente_cambio_perfil') }}" method="POST">
            @method('PATCH')
        @csrf
            <div class="py-5">
                <div class="grid grid-cols-3 gap-4">
                    <!-- Fila 1 -->
                    <div class="col-span-1">
                        <label class="font-poppins block text-gray-700 text-sm font-bold mb-2">
                            Nombre
                        </label>
                        <input id="txtNombre" name="nombre" type="text" class="rounded-md p-2 w-3/4" value="{{ $cliente->nombre_cliente }}">
                        @error('nombre')
                            <br>
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                
                    <div class="col-span-1">
                        <label class="font-poppins block text-gray-700 text-sm font-bold mb-2">
                            Personer&iacute;a
                        </label>
                        <input id="txtPersoneria" name="tipoCliente" type="text" disabled class="rounded-md p-2 w-3/4" value="{{ Str::ucfirst($cliente->tipo_cliente) }}">
                    </div>
                
                    <div class="col-span-1">
                        <label class="font-poppins block text-gray-700 text-sm font-bold mb-2">
                            Documento
                        </label>
                        <input id="txtDocumento" name="documento" type="text" class="rounded-md p-2 w-3/4" value="{{ $cliente->dni_cuit }}">
                        @error('documento')
                            <br>
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                
                    <!-- Fila 2 -->
                    <div class="col-span-1 pt-8">
                        <label class="font-poppins block text-gray-700 text-sm font-bold mb-2">
                            Email
                        </label>
                        <input id="txtEmail" name="email" type="email" class="rounded-md p-2 w-3/4" value="{{ $cliente->usuario->email }}">
                        @error('email')
                            <br>
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                
                    <div class="col-span-1 pt-8">
                        <label class="font-poppins block text-gray-700 text-sm font-bold mb-2">
                            C&oacute;digo Postal
                        </label>
                        <input id="txtCodigoPostal" name="codigoPostal" type="text" class="rounded-md p-2 w-3/4" value="{{ $cliente->codigo_postal_cliente }}">
                        @error('codigoPostal')
                            <br>
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                
                    <div class="col-span-1 pt-8">
                        <label class="font-poppins block text-gray-700 text-sm font-bold mb-2">
                            N&uacute;mero de T&eacute;lefono
                        </label>
                        <input id="txtNroTel" name="telefono" type="text" class="rounded-md p-2 w-3/4" value="{{ $cliente->nro_telefono }}">
                        @error('telefono')
                            <br>
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                
                </div>
                
            </div>

            <div class="relative flex flex-row">
                <button id="btnConfirmarCambios" type="submit" class="py-3 px-6 mb-5 rounded-lg text-center font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all">
                    Confirmar cambios
                </button>
            </div>
            
        </form>

        <div class="relative flex flex-row justify-end">
            @component('components.custom.modal_login')
                @slot('textoBtn', 'Cambiar contraseña')
                @slot('clasesBtn', 'flex select-none items-center gap-2 rounded-lg py-3 px-6 text-center align-middle font-sans text-sm font-bold bg-gray-500 text-white hover:bg-gray-500 transition-all active:bg-gray-600 disabled:opacity-50 disabled:shadow-none')
                @slot('encabezado', 'Ingrese su nueva contraseña')
                @slot('contenido')
                    <form  id="idFrmPsw" method="POST" action='{{ route('cliente_cambio_contrasenia') }}'>
                        @csrf
                        <div>
                            <label class='block font-medium text-sm text-zinc-700'>Ingrese su nueva contraseña</label>
                            <input id='idNuevaContrasenia' type='password' name='nuevaContrasenia' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                            @error('nuevaContrasenia')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label class='block font-medium text-sm text-zinc-700'>Reingrese la contraseña</label>
                            <input id='idConfirmacionNuevaContrasenia' type='password' name='password_confirmation' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                            @error('password_confirmation')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        
                        </div>
                        <div class='mt-4 flex items-center justify-end'>
                            <button type='submit' class='py-3 px-6 rounded-lg text-center font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all'>Confirmar</button>
                        </div>
                    </form>
                @endslot
            @endcomponent
        </div>
    </div>
    
    <div id="comprasRecientes" class="container mx-auto mt-10 bg-white rounded-2xl p-6">
        <h2 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
            Compras recientes
        </h2>
        <br>

        @if (count($ventas) > 0)
            @foreach ($ventas as $venta)
                @php
                    $fechaVenta = date('d-m-Y H:m', strtotime($venta->fecha_venta))
                @endphp

                <x-custom.sale-item  
                    :nroPago="$venta->nro_pago"
                    :domicilioEnvio="$venta->domicilio_destino"
                    :fechaVenta="$fechaVenta"
                    :totalVenta="$venta->monto_final_venta"
                    :ventaId="$venta->id"
                />
             @endforeach     

             <div class="flex justify-center">{{$ventas->links()}}</div>
        @else
            <div class="container mx-auto flex flex-wrap mb-1 overflow-hidden bg-gray-200 shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
                <p class='w-full py-20 font-bold text-2xl text-center'>No tiene compras realizadas</p>
            </div>
           
        @endif
        
    </div> 
    <br>  
    


</body>
</html>