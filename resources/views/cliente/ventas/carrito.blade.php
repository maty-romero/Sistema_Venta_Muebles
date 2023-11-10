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
    <x-custom.navbar_client></x-custom.navbar_client>

    <header class='lg:w-2/3 w-5/6 ml-auto mr-auto lg:mt-10 mt-4'>
    <div class="grid grid-cols-2 divide-x ">
        <h1 class='w-full md:text-5xl text-4xl text-left'>Carrito</h1>
        <h1 class='w-full md:text-5xl text-4xl text-right'>Total @money($subtotal)</h1>
    </div>
    @if(isset($msj))
        <p>{{$msj}}</p>
    @endif
    </header>

    <div class='lg:w-2/3 w-5/6 mx-auto lg:mt-10 pb-10 mt-4'>
        <section class="text-gray-700 body-font overflow-hidden">
        @if(!empty($carrito))
            @foreach ($carrito as $item)
                <x-custom.cart_item :item='$item'></x-custom.cart_item>
            @endforeach

        <p class='w-full text-right'>
        @component('components.custom.modal_login')
            @slot('textoBtn', 'Finalizar compra')
            @slot('clasesBtn', 'bg-zinc-700 hover:bg-zinc-500 text-white font-bold py-4 px-12 mt-2 mx-auto text-2xl rounded-md')

        @if (Auth::user())
            @slot('encabezado', 'Información de pago')
            @slot('contenido')
            <form  method="POST" action='{{ route('registrar_venta', Auth::user()->cliente->id_usuario_cliente) }}'>
                @csrf
                <div>
                    <label class='block font-medium text-sm text-zinc-700'>Medio de pago</label>
                    <select id='medioPago' name='medioPago' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                        <option></option>
                        <option>Opcion 1</option>
                    </select>
                    </div>
                <div class='mt-4'>
                    <label class='block font-medium text-sm text-zinc-700'>C&oacute;digo postal</label>
                    <input id='codPostal' type='number' name='codPostal' value='{{ Auth::user()->cliente->codigo_postal_cliente }}' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                </div>
                <div class='mt-4'>
                    <label class='block font-medium text-sm text-zinc-700'>Domicilio de destino</label>
                    <input id='direccionDestino' type='text' maxlength='100' name='direccionDestino' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                </div>
                <div class='mt-4 flex items-center justify-end'>
                    <button type='submit' class='inline-flex items-center px-4 py-2 bg-zinc-700 hover:bg-zinc-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Confirmar pago</button>
                </div>
            </form>
            @endslot
        @else
            @slot('encabezado', 'Iniciar sesión')
            @slot('contenido')
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label class='block font-medium text-sm text-zinc-700'>Email</label>
                        <input id='email' name='email' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                    </div>
                    <div class="mt-4">
                        <label class='block font-medium text-sm text-zinc-700'>Contrase&ntilde;a</label>
                        <input id='password' name='password' type='password' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-400 text-zinc-700 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                        </label>
                        <button type='submit' class='inline-flex ml-auto items-center px-6 py-2 bg-zinc-700 hover:bg-zinc-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Iniciar sesi&oacute;n</button>
                    </div>
                    <div class='flex pt-4 mt-4 border-t border-t-zinc-200'>
                        @if (Route::has('password.request'))
                            <a class="underline mr-2 text-sm text-zinc-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                Olvidaste tu contrase&ntilde;a?
                            </a>
                        @endif
                        <p class='text-right ml-auto text-sm text-zinc-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'> 
                        <a class="underline text-sm text-zinc-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                            Registrarse
                        </a>
                        </p>
                    </div>
                </form>
            @endslot
        @endif
        @endcomponent
        </p>

        @else
            <div class="container mx-auto flex flex-wrap mb-1 overflow-hidden bg-[#5690FF] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
              <p class='w-full py-20 text-white font-bold text-2xl text-center'>El carrito de compras est&aacute; vac&iacute;o</p>
            </div>
        @endif
        </section>
    </div>
</body>
</html>