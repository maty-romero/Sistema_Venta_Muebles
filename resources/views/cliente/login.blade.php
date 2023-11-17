<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registrar cliente</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="antialiased bg-[#FFE794] bg-pattern-image ">
    <x-custom.navbar_client></x-custom.navbar_client>

    <div class="flex items-center justify-center pt-16">
        <div class="bg-white p-8 rounded-2xl shadow-md max-w-3xl w-[400px]">

            @if(session('success'))
            <div class="bg-green-100 w-full border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 w-full border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <h2 class="font-figtree text-3xl mb-6 text-center font-bold">Muebles Patagonia</h2>

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
                    <button type='submit' class='inline-flex ml-auto items-center px-6 py-2 bg-zinc-700 hover:bg-zinc-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'>Iniciar
                        sesi&oacute;n</button>
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
        </div>
    </div>

</body>

</html>