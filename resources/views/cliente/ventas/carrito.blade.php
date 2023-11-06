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
    </header>

    <div class='lg:w-2/3 w-5/6 mx-auto lg:mt-10 pb-10 mt-4'>
        <x-custom.cart_item :carrito='$carrito'></x-custom.cart_item>
        <p class='w-full text-right'>
        
        @component('components.custom.modal_login')
            @slot('textoBtn', 'Finalizar compra')
            @slot('clasesBtn', 'bg-zinc-700 hover:bg-zinc-500 text-white font-bold py-4 px-12 mt-5 mx-auto text-2xl rounded-md')

        @if (Auth::user())
            
            @slot('encabezado', 'Información de pago')
            @slot('contenido')
            <form>
                <div>
                    <label class='block font-medium text-sm text-zinc-700'>Medio de pago</label>
                    <select id='medioPago' name='medioPago' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                        <option></option>
                        <option>Opcion 1</option>
                    </select>
                    </div>
                <div class='mt-4'>
                    <label class='block font-medium text-sm text-zinc-700'>C&oacute;digo postal</label>
                    <input id='codPostal' name='codPostal' value='{{ Auth::user()->getCodPostal() }}' required class='block w-full mt-1 border-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
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
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-400 text-zinc-700 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                        </label>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline mr-2 text-sm text-zinc-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <button type='submit' class='inline-flex items-center px-4 py-2 bg-zinc-700 hover:bg-zinc-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Iniciar sesi&oacute;n</button>
                    </div>
                </form>
            @endslot

        @endif

        @endcomponent

        </p>
    </div>
</body>
</html>