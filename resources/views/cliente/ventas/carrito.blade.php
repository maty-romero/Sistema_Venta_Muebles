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
        <h1 class='w-full md:text-5xl text-4xl text-right'>Total @money(90000)</h1>
    </div>
    </header>

    <div class='lg:w-2/3 w-5/6 mx-auto lg:mt-10 pb-10 mt-4'>
        <x-custom.cart_item :carrito='$carrito'></x-custom.cart_item>
        <p class='w-full text-right'>
        <button class="bg-zinc-700 hover:bg-zinc-500 text-white font-bold py-4 px-12 mt-5 mx-auto text-2xl rounded">
            Finalizar compra
        </button>
        </p>
    </div>
</body>

</html>