<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Carrito</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="antialiased bg-[#FFE794] bg-pattern-image ">
    <x-custom.navbar_carrito></x-custom.navbar_carrito>

    <div class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-4">Carrito de compras</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                        <!-- Contenido del carrito (puedes personalizar según tus necesidades) -->
                        @if (session('msj'))
                            <div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <span class="block sm:inline">{{ session('msj') }}</span>
                            </div>
                        @endif

                        @if (!empty($carrito))
                            @foreach ($carrito as $item)
                                <x-custom.cart_item :item='$item'></x-custom.cart_item>
                            @endforeach
                        @else
                            <div
                                class="container mx-auto flex flex-wrap mb-1 overflow-hidden bg-[#5690FF] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
                                <p class='w-full py-20 text-white font-bold text-2xl text-center'>
                                    El carrito de compras est&aacute;vac&iacute;o
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Resumen de la compra</h2>

                        <div class="mb-4">
                            <label class='block font-medium text-base text-zinc-700'>Código postal</label>
                            @if (Auth::user())
                                <input id='codPostal' type='number' name='codPostal'
                                    value='{{ Auth::user()->cliente->codigo_postal_cliente }}' required
                                    class='w-full border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                                @error('codPostalHidden')
                                    <br>
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror

                            @else
                                <input id='codPostal' type='number' name='codPostal' value="{{old('codPostal')}}" required
                                    class='w-full border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                                @error('codPostalHidden')
                                    <br>
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            @endif
                        </div>

                        <div>
                            <label class='block font-medium text-base text-zinc-700'>Domicilio de destino</label>
                            <input id='direccionDestino' type='text' maxlength='100' name='direccionDestino' value="{{ old('direccionDestino') }}" required
                                class='w-full border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                            @error('direccionDestinoHidden')
                                <br>
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr class="my-2">
                        {{-- Totales --}}
                        @if (isset($ofertaMonto->porcentaje_descuento))
                            @php
                                //Total sin descuento monto --> $subtotal
                                $descuentoMonto = ($subtotal * $ofertaMonto->porcentaje_descuento) / 100;
                                $totalFinal = $subtotal * (1 - $ofertaMonto->porcentaje_descuento / 100);
                            @endphp

                            <div class="flex justify-between mb-2">
                                <span class="text-base">Subtotal: @money($subtotal)</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-base">Descuento monto: - @money($descuentoMonto)
                                    ({{ $ofertaMonto->porcentaje_descuento }})%</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold text-base">Total @money($totalFinal)</span>
                            </div>
                        @else
                            <div class="flex justify-between mb-2">
                                <span class="text-base">Total @money($subtotal)</span>
                            </div>
                        @endif

                        {{-- Boton finalizar compra con verificación de logeo --}}
                        @component('components.custom.modal_login')
                            @slot('textoBtn', 'Finalizar compra')
                            @slot('clasesBtn', 'bg-zinc-700 hover:bg-zinc-500 text-white font-bold py-4 px-12 mt-2 mx-auto
                                text-xl rounded-md')

                                @if (Auth::user())
                                    @slot('encabezado', 'Información de pago')
                                    @slot('contenido')

                                        <form id="idfrmEnvioFinalizar" method="POST"
                                            action='{{ route('registrar_venta', Auth::user()->cliente->id_usuario_cliente) }}'>
                                            @csrf
                                            <div>
                                                <label class='block font-medium text-base text-zinc-700'>Medio de pago</label>
                                                <select id='medioPago' name='medioPago' required
                                                    class='block w-full mt-1 border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                                                    <option></option>
                                                    <option>Tarjeta de crédito</option>
                                                    <option>Tarjeta de débito</option>
                                                </select>
                                            </div>
                                            <div class='mt-4'>
                                                <label class='block font-medium text-base text-zinc-700'>Número de Tarjeta</label>
                                                <input id='nroTarjeta' type='number' name='nroTarjeta' required
                                                    class='block w-full mt-1 border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                                            </div>
                                            <div class='mt-4'>
                                                <label class='block font-medium text-base text-zinc-700'>Fecha de Caducidad</label>
                                                <table>
                                                    <tr>
                                                        <td><label class='block font-medium text-base text-zinc-700'>Mes</label>
                                                        </td>
                                                        <td><label class='block font-medium text-base text-zinc-700'>Año</label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><select id='mes' name='mes' required
                                                                class='block w-full mt-1 border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                                <option>7</option>
                                                                <option>8</option>
                                                                <option>9</option>
                                                                <option>10</option>
                                                                <option>11</option>
                                                                <option>12</option>
                                                            </select></td>
                                                        <td><select id='ano' name='ano' required
                                                                class='block w-full mt-1 border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm '>
                                                                <option>2023</option>
                                                                <option>2024</option>
                                                                <option>2025</option>
                                                                <option>2026</option>
                                                                <option>2027</option>
                                                                <option>2028</option>
                                                                <option>2029</option>
                                                            </select></td>
                                                    </tr>
                                                    <td>
                                                        <div class='mt-4 flex items-center justify-end'>
                                                            <span class="text-base">Total a pagar: @money($subtotal)</span>
                                                    </td>
                                                </table><br>
                                            </div>

                                            <!-- Datos del envío -->
                                            <input type="hidden" name="codPostalHidden" id="codPostalHidden" value="">
                                            <input type="hidden" name="direccionDestinoHidden" id="direccionDestinoHidden"
                                                value="">



                                            <button type='submit'
                                                class='inline-flex items-center px-4 py-2 bg-zinc-700 hover:bg-zinc-500 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Realizar
                                                pago</button>
                                </div>
                                </form>
                            @endslot
                        @else
                            @slot('encabezado', 'Iniciar sesión')
                            @slot('contenido')
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div>
                                        <label class='block font-medium text-base text-zinc-700'>Email</label>
                                        <input id='email' name='email' required
                                            class='block w-full mt-1 border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                                    </div>
                                    <div class="mt-4">
                                        <label class='block font-medium text-base text-zinc-700'>Contraseña</label>
                                        <input id='password' name='password' type='password' required
                                            class='block w-full mt-1 border-gray-400 text-base focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox"
                                                class="rounded border-gray-400 text-zinc-700 shadow-sm focus:ring-indigo-500"
                                                name="remember">
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                                        </label>
                                        <button type='submit'
                                            class='inline-flex ml-auto items-center px-6 py-2 bg-zinc-700 hover:bg-zinc-500 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Iniciar
                                            sesión</button>
                                    </div>
                                    <div class='flex pt-4 mt-4 border-t border-t-zinc-200'>
                                        @if (Route::has('password.request'))
                                            <a class="underline mr-2 text-base text-zinc-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                href="{{ route('password.request') }}">
                                                ¿Olvidaste tu contraseña?
                                            </a>
                                        @endif
                                        <p
                                            class='text-right ml-auto text-base text-zinc-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'>
                                            <a class="underline text-base text-zinc-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                href="{{ route('register') }}">
                                                Registrarse
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            @endslot
                            @endif
                        @endcomponent
                    </div>
                </div>

            </div>
        </div>


    </body>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var finalizarCompraBtn = document.getElementById('myBtn');

            var formularioEnvio = document.getElementById("idfrmEnvioFinalizar");

            // Obtener los campos de código postal y domicilio ingresados 
            var codPostalInput = document.getElementById("codPostal");
            var direccionDestinoInput = document.getElementById("direccionDestino");

            // Cuando se envía el formulario, asignar valores a campos ocultos
            formularioEnvio.addEventListener("submit", function() {
                document.getElementById("codPostalHidden").value = codPostalInput.value;
                document.getElementById("direccionDestinoHidden").value = direccionDestinoInput.value;
            });
        });
    </script>



    </html>
