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

    @php
        dump($usuario);
        dump($ventas);
    @endphp

    <div id="infoCliente" class="container mx-auto bg-white rounded-2xl p-6">
        <h3 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Perfil del cliente</h3>
        <form action="">

            <div class="py-5">
                <table>
                    <tr>
                        <td class="pr-16"><label class="font-poppins">Nombre</label></td>
                        <td class="pr-16"><label class="font-poppins">Personer&iacute;a</label></td>
                        <td class="pr-16"><label class="font-poppins">Documento</label></td>
                    </tr>
                    <tr>
                        <td class="pr-16"><input id="txtNombre" type="text" class="rounded-md"></td>
                        <td class="pr-16"><input id="txtPersoneria" type="text" disabled class="rounded-md"></td>
                        <td class="pr-16"><input id="txtDocumento" type="text" class="rounded-md"></td>
                    </tr>
                    <tr>
                        <td class="pr-16 pt-8"><label class="font-poppins">Email</label></td>
                        <td class="pr-16 pt-8"><label class="font-poppins">C&oacute;digo Postal</label></td>
                        <td class="pr-16 pt-8"><label class="font-poppins">N&uacute;mero de T&eacute;lefono</label></td>
                    </tr>
                    <tr>
                        <td class="pr-16"><input id="txtEmail" type="text" class="rounded-md"></td>
                        <td class="pr-16"><input id="txtCodigoPostal" type="text" class="rounded-md"></td>
                        <td class="pr-16"><input id="txtNroTel" type="text" class="rounded-md"></td>
                    </tr>
                </table>
            </div>
            
            <div class="relative flex flex-row">
                <button class="flex select-none items-center gap-2 rounded-lg py-3 px-6 text-center align-middle font-sans text-sm font-bold bg-gray-500 text-white hover:bg-gray-500 transition-all active:bg-gray-600 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    Editar Contraseña
                </button>
            </div>
            <br>
            <div class="relative flex flex-row">
                <button id="btnConfirmarCambios" class="ml-auto py-3 px-6 rounded-lg text-center font-sans text-sm font-bold bg-green-500 text-white hover:bg-green-600 transition-all" type="button">
                    Confirmar cambios
                </button>
            </div>
            
        </form>
    </div>
    
    <div id="comprasRecientes" class="container mx-auto mt-10 bg-white rounded-2xl p-6">
        <h2 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">Compras recientes</h2><br>
        
        @php

            $items_venta = [
                [
                    'imagenURL' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=150&amp;q=80 ',
                    'nombreProducto' => 'Silla',
                    'descripcionProducto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean auctor nisl eget nunc consectetur, ut dictum lectus convallis. Donec mi lorem, tincidunt in facilisis sed, feugiat ac nunc. Cras tincidunt id nisl nec dapibus. Nullam mollis lectus a venenatis dapibus. Quisque non euismod turpis. Curabitur a nisl nisl. Nunc tincidunt ac nibh vel mattis. Proin vel luctus eros. Vestibulum ac nulla condimentum, consectetur purus id, consequat lectus.',
                    'fechaVenta' => '10/10/20',
                    'totalVenta' => '4000' 
                ],
                [
                    'imagenURL' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                    'nombreProducto' => 'Auriculares',
                    'descripcionProducto' => 'Ut consequat diam in nunc malesuada fermentum. Nulla ut ligula sagittis, porta neque a, pulvinar ex. Phasellus vel vulputate nunc. Curabitur placerat suscipit massa, in feugiat ligula elementum vulputate. Aliquam posuere fermentum finibus. Aliquam iaculis dapibus iaculis. In tristique augue et efficitur feugiat. Sed ut nibh a nulla vehicula accumsan.',
                    'fechaVenta' => '20/11/22',
                    'totalVenta' => '8000'     
                ]
            ]; 

        @endphp

        @foreach ($items_venta as $item)
            <x-custom.sale-item  
            :imagenURL="$item['imagenURL']"
            :nombreProducto="$item['nombreProducto']"
            :descripcionProducto="$item['descripcionProducto']"
            :fechaVenta="$item['fechaVenta']"
            :totalVenta="$item['totalVenta']"
            />
        @endforeach
        
              
        
         
    </div>    
</body>
</html>