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
        <form action="{{ route('cliente_cambio_perfil') }}" method="POST">
            @method('PATCH')
        @csrf
            <div class="py-5">
                <table>
                    <tr>
                        <td class="pr-16"><label class="font-poppins">Nombre</label></td>
                        <td class="pr-16"><label class="font-poppins">Personer&iacute;a</label></td>
                        <td class="pr-16"><label class="font-poppins">Documento</label></td>
                    </tr>
                    <tr>
                        <td class="pr-16"><input id="txtNombre" name="nombre" type="text" class="rounded-md" value="{{ $cliente->nombre_cliente }}"></td>
                        <td class="pr-16"><input id="txtPersoneria" name="tipoCliente" type="text" disabled class="rounded-md" value="{{ Str::ucfirst($cliente->tipo_cliente) }}"></td>
                        <td class="pr-16"><input id="txtDocumento" name="documento" type="text" class="rounded-md" value="{{ $cliente->dni_cuit }}"></td>
                    </tr>
                    <tr>
                        <td class="pr-16 pt-8"><label class="font-poppins">Email</label></td>
                        <td class="pr-16 pt-8"><label class="font-poppins">C&oacute;digo Postal</label></td>
                        <td class="pr-16 pt-8"><label class="font-poppins">N&uacute;mero de T&eacute;lefono</label></td>
                    </tr>
                    <tr>
                        <td class="pr-16"><input id="txtEmail" name="email" type="email" class="rounded-md" value="{{ $cliente->usuario->email }}"></td>
                        <td class="pr-16"><input id="txtCodigoPostal" name="codigoPostal" type="text" class="rounded-md" value="{{ $cliente->codigo_postal_cliente }}"></td>
                        <td class="pr-16"><input id="txtNroTel" name="telefono" type="text" class="rounded-md" value="{{ $cliente->nro_telefono }}"></td>
                    </tr>
                </table>
            </div>

            <div class="relative flex flex-row">
                <button id="btnConfirmarCambios" type="submit" class="py-3 px-6 mb-5 rounded-lg text-center font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all">
                    Confirmar cambios
                </button>
            </div>
            
        </form>

        <div class="relative flex flex-row">
            @component('components.custom.modal_login')
                @slot('textoBtn', 'Editar Contraseña')
                @slot('clasesBtn', 'flex select-none items-center gap-2 rounded-lg py-3 px-6 text-center align-middle font-sans text-sm font-bold bg-gray-500 text-white hover:bg-gray-500 transition-all active:bg-gray-600 disabled:opacity-50 disabled:shadow-none')
                @slot('encabezado', 'Ingrese su nueva contraseña')
                @slot('contenido')
                    <form  id="idFrmPsw" method="POST" action='{{ route('cliente_cambio_contrasenia') }}'>
                        @csrf
                        <div>
                            <label class='block font-medium text-sm text-zinc-700'>Ingrese su nueva contraseña</label>
                            <input id='idNuevaContrasenia' type='password' name='nuevaContrasenia' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
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
                    $imagenURL = $venta->producto->first()->imagenURL ?? $venta->ofertaCombo->first()->imagenURL;
                    $fechaVenta = date('d-m-Y H:m', strtotime($venta->fecha_venta))
                @endphp

                <x-custom.sale-item  
                    :imagenURL="$imagenURL"
                    :nroPago="$venta->nro_pago"
                    :domicilioEnvio="$venta->domicilio_destino"
                    :fechaVenta="$fechaVenta"
                    :totalVenta="$venta->monto_final_venta"
                    :ventaId="$venta->id"
                />
            @endforeach    
        @endif
              
    </div> 
    <br>   


</body>
</html>