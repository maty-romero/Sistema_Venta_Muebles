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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="antialiased bg-[#F0F0F0] bg-pattern-image ">
    
    <x-custom.navbar_adm></x-custom.navbar_adm>

    <div class='flex m-0 p-0 float-left h-screen transition-transform -translate-x-full sm:translate-x-0'>
       <x-custom.sidebar></x-custom.sidebar>
    </div>

    <div class='overflow-hidden h-fit float-center w-max-content m-0'>
        <header class='w-full ml-[8%] mt-4'>
            <h1 class='text-6xl text-left'>@yield('encabezado')</h1>
        </header>
        <div class='overflow-hidden w-max-content float-center mt-5 ml-[8%]'>
            @yield('contenido')
        </div>
    </div>

</body>

</html>