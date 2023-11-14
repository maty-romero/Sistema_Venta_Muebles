<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$combo->nombre_combo}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="antialiased bg-[#FFE794] bg-pattern-image ">
    <x-custom.navbar_client>
    </x-custom.navbar_client>

    <header class='px-32 mr-auto mt-10'>
        <h1 class='text-6xl text-left'>Combos</h1>
    </header>

    <div class='px-32 mt-10 pb-10'>
        <x-custom.combo_detail :combo='$combo' :enCarrito='$enCarrito'></x-custom.combo_detail>
    </div>

</body>

</html>