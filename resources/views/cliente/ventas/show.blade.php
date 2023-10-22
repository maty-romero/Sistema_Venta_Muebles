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

    <title>Detalle Compra</title>

</head>
<body class="antialiased bg-[#FFE794] shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)] bg-pattern-image">
    <x-custom.navbar>
    </x-custom.navbar>
    <div id="detalleVenta" class="container mx-auto p-6">
        <h1 class="mb-2 block font-sans text-5xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Detalle Compra</h1><br>
        <x-custom.table>
        </x-custom.table>
    
        <div class="bg-gray-600 container mx-auto rounded-lg p-6">
            <div class="flex justify-between">
                <p class="text-white font-poppins text-2xl">Total</p>
                <p class="text-white font-poppins text-2xl">$3000</p>
            </div>
            <div class="flex justify-between">
                <p class="text-white font-poppins text-2xl">Fecha Facturaci&oacute;n</p>
                <p class="text-white font-poppins text-2xl">01/10/2023</p>
            </div>
            <div class="flex justify-between">
                <p class="text-white font-poppins text-2xl">Domicilio Facturaci&oacuten</p>
                <p class="text-white font-poppins text-2xl">Calle Ejemplo #123</p>
            </div>
        </div>
        
        <br>
        <div class="flex justify-end">
            <button class="bg-gray-800 text-white py-2 px-4 rounded-md text-base">
                Ver Comprobante
            </button>
        </div>
    </div>
    
    
    
    
    
    
    
    
              
        
         
       
</body>
</html>