<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @yield('scripts')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
    
@if(Auth::user() == null || Auth::user()->rol_usuario == 'cliente')

<body class="antialiased bg-[#FFE794] bg-pattern-image">
    <x-custom.navbar_client></x-custom.navbar_client>
    <br><br><br>
    <div class="container w-3/4 mt-20 mx-auto mb-1 bg-[#5690FF] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
        <p class='w-full py-20 text-white font-bold text-2xl text-center'>La p&aacute;gina que est&aacute; buscando no existe</p>
    </div>

@else

<body class="antialiased bg-[#F0F0F0] bg-pattern-image">
    <x-custom.navbar_adm></x-custom.navbar_adm>

    <div class='flex w-full m-0'>
        <div class='min-h-screen m-0 p-0 float-left h-max-content transition-transform -translate-x-full sm:translate-x-0'>
            <x-custom.sidebar></x-custom.sidebar>
    </div>

    <div class="container overflow-hidden h-fit w-3/4 mt-20 mx-auto mb-1 bg-[#343B53] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
        <p class='w-full py-20 text-white font-bold text-2xl text-center'>La p&aacute;gina que est&aacute; buscando no existe</p>
    </div>

@endif

    </body>

</html>